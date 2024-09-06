import React, { useState } from "react";
import ReactTimeago from "react-timeago";
import DropdownButton from "./components/DropdownButton";
import toastr from "toastr";
import "/node_modules/toastr/build/toastr.min.css";

export default function CategoryPostDetail({
  user,
  categoryPost,
  postComments,
}) {
  const [comments, setComments] = useState(postComments);
  const [comment, setCommentText] = useState("");

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  const handleSubmitComment = async () => {
    if (comment.length === 0) {
      return;
    }

    try {
      const response = await fetch(
        route("web.category.post.comment.store", categoryPost.id),
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({ postId: categoryPost.id, comment }),
        }
      );

      if (!response.ok) {
        throw new Error("Failed to submit comment");
      }

      const newComment = {
        id: comments.length + 1,
        author: { name: user.name, img: user.img },
        content: comment,
        created_at: new Date().toISOString(),
        updated_at: new Date().toISOString(),
      };
      // console.log("New comment:", newComment);
      setComments([newComment, ...comments]);
      setCommentText("");
    } catch (error) {
      console.error("Error submitting comment:", error);
    }
  };

  const options = [
    {
      label: "Delete Comment",
      iconClass: "fa-regular fa-trash-can",
      action: ({ commentId }) => handleDeleteComment(commentId),
    },
    {
      label: "Mute User",
      iconClass: "fa-solid fa-volume-xmark",
      action: ({ userId }) => handleMuteUser(userId),
    },
  ];

  async function handleDeleteComment(commentId) {
    const response = await fetch(
      route("web.category.post.comment.delete", commentId),
      {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
        },
      }
    );
    const data = await response.json();

    if (!response.ok) {
      toastr.error(data.message);
    } else {
      setComments(comments.filter((comment) => comment.id !== commentId));
      toastr.success(data.message);
    }

    // toastr.success(response.json());
  }

  async function handleMuteUser(userId) {
    const response = await fetch(route("admin.user.mute", userId));

    if (response.ok) {
      toastr.success("User muted successfully");
    } else {
      toastr.error("Failed to mute user");
    }
  }

  return (
    <div className="min-h-[calc(100vh-6rem)] bg-gray-200">
      <div className="justify-center py-10 mx-auto sm:container sm:p-10">
        <div className="block max-w-4xl mx-auto bg-white rounded-lg shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface">
          <div className="p-6">
            <h5 className="mb-2 text-2xl font-semibold leading-tight">
              {categoryPost.title}
            </h5>
            <div className="flex gap-2 m-1 text-gray-500">
              <small className="flex items-center gap-1">
                <span>
                  <i className="text-gray-400 fa-solid fa-eye"></i>
                </span>
                <span>{categoryPost.views}</span>
              </small>
              <small className="flex items-center gap-1">
                <span>
                  <i className="text-gray-400 fa-solid fa-clock"></i>
                </span>
                <span>{categoryPost.formated_created_at}</span>
              </small>
            </div>

            <div
              className="my-5"
              dangerouslySetInnerHTML={{ __html: categoryPost.body }}
            ></div>
          </div>

          {!user.isMuted && (
            <div className="px-6 py-3 border-t-2 border-gray-200 dark:border-white/10 text-surface/75 dark:text-neutral-300">
              <div className="flex items-center gap-4 my-3">
                <div className="flex-grow-0 flex-shrink-0 w-12 h-12 rounded-full">
                  <img
                    className="rounded-full"
                    src={`/images/user_avatar/${user.img}`}
                    alt=""
                  />
                </div>
                <input
                  className="w-11/12 bg-gray-100 rounded-full"
                  type="text"
                  placeholder="Write something..."
                  value={comment}
                  onChange={(e) => setCommentText(e.target.value)}
                />
                <button
                  className="p-2 rounded-full bg-primary"
                  onClick={handleSubmitComment}
                >
                  <span>
                    <i className="font-bold text-white fa-2x fa-regular fa-paper-plane"></i>
                  </span>
                </button>
              </div>
            </div>
          )}

          <div className="px-6 py-3 border-t-2 border-gray-200 dark:border-white/10 text-surface/75 dark:text-neutral-300">
            <div className="flex flex-col gap-3">
              {comments.map((comment, index) => (
                <Comment
                  key={comment.id}
                  comment={comment}
                  options={options}
                  user={user}
                ></Comment>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

function Comment(props) {
  return (
    <div className="flex items-center gap-2 my-2">
      <div className="flex-grow-0 flex-shrink-0 w-12 h-12">
        <img
          className="rounded-full"
          src={`/images/user_avatar/${props.comment.author.img}`}
          alt=""
        />
      </div>

      <div className="flex flex-col p-4 bg-gray-100 rounded-lg">
        <div className="flex items-center gap-2">
          <span className="text-sm font-semibold text-gray-900 dark:text-white">
            {props.comment.author.name}
          </span>
          <span className="text-sm font-normal text-gray-500 dark:text-gray-400">
            <ReactTimeago date={props.comment.created_at} />
          </span>
          {props.user.isAdmin && (
            <DropdownButton
              options={props.options}
              commentId={props.comment.id}
              userId={props.comment.author.id}
            />
          )}
        </div>
        <p className="w-full">{props.comment.content}</p>
      </div>
    </div>
  );
}
