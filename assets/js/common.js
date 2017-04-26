jQuery(document).ready(function() {

  jQuery(document).on("click", ".deleteUser", function() {
    var userId = $(this).data("userid"),
      hitURL = baseURL + "deleteUser",
      currentRow = $(this);

    var confirmation = confirm("Are you sure to delete this user ?");

    if (confirmation) {
      jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: hitURL,
        data: {
          userId: userId
        }
      }).done(function(data) {
        console.log(data);
        currentRow.parents('tr').remove();
        if (data.status = true) {
          alert("User successfully deleted");
        } else if (data.status = false) {
          alert("User deletion failed");
        } else {
          alert("Access denied..!");
        }
      });
    }
  });

  jQuery(document).on("click", ".deleteTask", function() {
    var taskId = $(this).data("taskid"),
      hitURL = baseURL + "deleteTask",
      currentRow = $(this);

    $('#myModal').modal('show');

    $('#deleteBtn').click(function() {
      jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: hitURL,
        data: {
          taskId: taskId
        }
      }).done(function(data) {
		console.log(data);
        currentRow.parents('tr').remove();
        if (data.status === true) {
          console.log("Task successfully deleted");
          window.location.reload(true);
        } else if (data.status === false) {
          console.log("Task deletion failed");
          window.location.reload(true);
        } else {
          $('#myModal').modal('hide');
          alert("Access denied..!");
        }
      }).fail(function() {
        alert("error");
      });
    });
  });


  jQuery(document).on("click", ".searchList", function() {});

});
