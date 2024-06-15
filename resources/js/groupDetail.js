import $ from "jquery";
document.addEventListener("DOMContentLoaded", function () {
  var $j = $.noConflict();
  // $j(document).ready(function () {
  $j(document).on("submit", "#create-post-modal form", function (e) {
    e.preventDefault();

    var form = $j(this);
    var submitUrl = form.attr("action");
    var method = form.attr("method");

    var submitButton = form.find('button[type="submit"]');
    submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

    var formData = new FormData(this);

    // Make an AJAX request
    $j.ajax({
      url: submitUrl,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        submitButton.html("Save changes");
        $j("#create-post-modal form")[0].reset();

        if (response.error == true) {
          Swal.fire({
            title: "Error!",
            text: response.data.message,
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          console.error("Error saving post:", error.responseText);
          return false;
        } else {
          $j("#post-list").html(response.data.posts);
          console.log("slksssssssssssss", response);
          Swal.fire({
            title: "Success!",
            text: response.data.message,
            icon: "success",
            showConfirmButton: true,
          }).then((value) => {});
        }
        // $('#create-post-modal').addClass('hidden');
        // new Modal('#comments-modal', options, instanceOptions).toggle;
        // Flowbite.Modal.show('#comments-modal');
        // const commentModal = new Modal(document.getElementById('#comments-modal'));
        // commentModal.hide()
      },
      error: function (error) {
        submitButton.html("Save changes");
        const errorMessage = error.responseJSON.message;
        console.error("Error:", errorMessage);
        if (errorMessage == "Unauthenticated.") {
          $j("#create-new-group").hide();

          Swal.fire({
            title: "Error!",
            text: "Please login to create group",
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          return false;
        }
      },
    });
  });

  $j(document).on("click", ".create-comment-btn", function (e) {
    var post_id = $j(this).data("post_id");
    $j("#hidden_post_id").val(post_id);
  });

  $j(document).on("submit", "#comment-form", function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    var form = $j(this);
    var submitUrl = form.attr("action");
    var method = form.attr("method");

    var submitButton = form.find('button[type="submit"]');
    submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

    var formData = new FormData(this);

    // Make an AJAX request
    $j.ajax({
      url: submitUrl,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        submitButton.html("Save changes");
        $j("#comment-form")[0].reset();

        if (response.error == true) {
          Swal.fire({
            title: "Error!",
            text: response.data.message,
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          console.error("Error saving post:", error.responseText);
          return false;
        } else {
          var post_id = formData.get("post_id");
          $j("#comment_count_" + post_id).html(response.data.comment_count);
          Swal.fire({
            title: "Success!",
            text: response.data.message,
            icon: "success",
            showConfirmButton: true,
          }).then((value) => {});
        }
        $j("#create-post-modal").addClass("hidden");
      },
      error: function (error) {
        submitButton.html("Save changes");
        const errorMessage = error.responseJSON.message;
        console.error("Error:", errorMessage);
        if (errorMessage == "Unauthenticated.") {
          $j("#create-new-group").hide();

          Swal.fire({
            title: "Error!",
            text: "Please login to create group",
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          return false;
        }
      },
    });
  });

  $j(document).on("click", ".comment-list", function (e) {
    const postCommentsRoute = $j(this).data("comments-route");
    $j("#popup-comment-list").html(
      '<span class="text-center">Loading...</span>'
    );
    $j.ajax({
      url: postCommentsRoute,
      type: "GET",
      data: {
        post_id: $j(this).data("post_id"),
      },
      success: function (response) {
        if (response.error == true) {
          Swal.fire({
            title: "Error!",
            text: response.data.message,
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          console.error("Error saving post:", error.responseText);
          return false;
        } else {
          $j("#popup-comment-list").html(response.data.comments);
        }
      },
      error: function (error) {
        console.error("Error:", error.message);
      },
    });
  });

  $j(document).on("click", ".like-post", function (e) {
    const button = $j(this);
    $j.ajax({
      url: $(this).data("route"),
      type: "POST",
      data: {
        post_id: $(this).data("post_id"),
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      // dataType: 'html',
      success: function (response) {
        if (response.error == true) {
          Swal.fire({
            title: "Error!",
            text: response.data.message,
            icon: "error",
            showConfirmButton: true,
          }).then((value) => {});
          console.error("Error saving post:", error.responseText);
          return false;
        } else {
          var post_id = response.data.post_id;
          $j("#like_count_" + post_id).html(response.data.like_count);
          button.html(response.data.button);

          // Swal.fire({
          //     title: 'Success!',
          //     text: response.data.message,
          //     icon: 'success',
          //     showConfirmButton: true,
          // }).then((value) => {

          // });
        }
      },
      error: function (error) {
        console.error("Error:", errorMessage);
      },
    });
  });

  $j(document).on("click", ".view-all-replies", function (e) {
    e.preventDefault();
    var commentId = $j(this).data("comment_id");
    $j("#comment" + commentId + " .additional-replies").css("display", "flex");
    $j(this).hide();
  });

  $j(document).on("click", ".edit-button", function (e) {
    // Get the current comment content
    var currentContent = $(this).siblings("div").find("p").text();
    console.log("llllllllllllllll", $(this).data("url"));
    // Replace the comment content with an input field, pre-filled with the current content
    $(this)
      .siblings("div")
      .find("p")
      .replaceWith(
        '<input type="text" class="edit-field" value="' + currentContent + '">'
      );

    // focus on the input field
    $(this).siblings("div").find("input").focus();

    // make cursor at the end of the input field
    $(this)
      .siblings("div")
      .find("input")
      .get(0)
      .setSelectionRange(currentContent.length, currentContent.length);

    // Change the edit button to a save button
    $(this)
      .html('<i class="fa-solid fa-save"></i>')
      .addClass("save-button")
      .removeClass("edit-button");
  });

  // When the save button is clicked
  $j(document).on("click", ".save-button", function () {
    // Get the new comment content
    var thisContext = $(this);
    var newContent = $(this).siblings("div").find("input").val();
    console.log("ssaavvee", $(this).data("url"));

    var newParagraph =
      '<p class="py-2 text-sm font-normal text-gray-900 dark:text-white">' +
      newContent +
      "</p>";
    $(this).siblings("div").find("input").replaceWith(newParagraph);

    // Change the save button back to an edit button
    $(this)
      .html('<i class="fa-solid fa-pencil"></i>')
      .addClass("edit-button")
      .removeClass("save-button");

    // Send a POST AJAX request to update the comment
    $.ajax({
      type: "POST",
      url: $(this).data("url"),
      data: {
        content: newContent,
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function (response) {
        // Replace the input field with a p tag containing the new content
      },
      error: function (xhr, status, error) {
        // Handle error responses
        console.error(xhr.responseText);
      },
    });
  });

  // End edit comment
  // });

  // Reply
  let replyRoute;
  $j(document).on("click", ".reply-button", function (e) {
    const commentId = $j(this).parent().attr("id");
    const commentPrimaryId = $j(this).parent().data("comment_id");
    replyRoute = $j(this).parent().data("reply_route");

    if (!$j(`#replyBox${commentId}`).length) {
      const replyBox = `
        <div class="flex items-end w-11/12 gap-4 py-2" id="replyBox${commentId}">
          <input class="rounded-md" type="text" id="reply${commentId}" placeholder="Write a reply...">
          <button data-comment_id="${commentId}" data-comment_primary_id="${commentPrimaryId}" class="px-3 py-2 text-white bg-blue-500 rounded-md postReply" type="button">Post</button>
        </div>
      `;

      $j(this).siblings(".replies").append(replyBox);
      setTimeout(() => $j(`#reply${commentId}`).focus(), 0);
    }
  });

  $j(document).on("click", ".postReply", function (e) {
    e.preventDefault();
    const commentId = $j(this).data("comment_id");
    const commentPrimaryId = $j(this).data("comment_primary_id");
    console.log(replyRoute);
    postReply(commentId, commentPrimaryId);
  });
  function postReply(commentId, commentIdPrimary) {
    const replyInput = $(`#reply${commentId}`);
    const replyBox = $(`#replyBox${commentId}`);
    const replyText = replyInput.val();

    console.log(replyRoute);

    replyBox.remove();

    $.ajax({
      type: "POST",
      url: replyRoute,
      data: {
        content: replyText,
        commentId: commentIdPrimary,
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function (response) {
        const replyDiv = createReplyDiv(replyText, response.data.update_url);
        $(`#${commentId} .replies`).append(replyDiv);
      },
      error: function () {
        alert("Error posting reply. Please try again.");
      },
    });
  }

  function createReplyDiv(replyText, updateUrl) {
    const userImgSrc = $(`#userImg`).attr("src");
    const userNameText = $(`#userName`).text();
    return `
        <div class="flex items-start w-11/12 gap-2 ml-auto reply">
            <img class="w-8 h-8 rounded-full" src="${userImgSrc}" alt="{{ auth()->user()->name }} image">
            <div class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${userNameText}</span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Now</span>
                </div>
                <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">${replyText}</p>
            </div>
            <button data-url="${updateUrl}" class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button" type="button">
                <i class="fa-solid fa-pencil"></i>
            </button>
        </div>
    `;
  }
  // End Reply

  // DOMContentLoaded
});
