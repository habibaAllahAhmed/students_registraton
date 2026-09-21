$("#searchForm").submit(function (e) {
  e.preventDefault();

  let dataForm = new FormData(this);

  $.ajax({
    url: "backend/search.php",
    type: "POST",
    data: dataForm,
    success: function (data) {
      console.log(data);
      showStudents(data);
    },

    error: function (error) {
      let message = "Something went wrong";

      if (error.responseJSON && error.responseJSON.message) {
        message = error.responseJSON.message;
      }

      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
      });
    },
  });
});

function deleteStudent(student_id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "backend/deleteStudent.php",

        type: "POST",

        data: {
          student_id: student_id,
        },

        success: function (data) {
          $(`tr[data-student-id="${student_id}"]`).remove();

          Swal.fire({
            title: "Deleted!",
            text: "Student has been deleted.",
            icon: "success",
          });
        },

        error: function (error) {
          let message = "Something went wrong";

          if (error.responseJSON && error.responseJSON.message) {
            message = error.responseJSON.message;
          }

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: message,
          });
        },
      });
    }
  });
}

function showStudents(response) {
  let students = response.data;

  $("tbody").html("");

  let tbodyContent = "";

  for (let i = 0; i < students.length; i++) {
    let shortPass = students[i]["password"].substring(0, 15);

    tbodyContent += `
      <tr data-student-id="${students[i]["id"]}">

        <th>${students[i]["id"]}</th>

        <td>
          ${students[i]["first_name"]} ${students[i]["last_name"]}
        </td>

        <td>
          ${students[i]["email"]}
        </td>

        <td>
          ${shortPass}...
        </td>

        <td>
          ${students[i]["age"]}
        </td>

        <td>
          ${students[i]["phone"]}
        </td>

        <td>
          <div class="buttons">

            <a
              href="editStudentsForm.php?student_id=${students[i]["id"]}"
              class="btn btn-info text-light"
            >
              Edit
            </a>

            <button
              class="btn btn-danger text-light"
              onclick="deleteStudent(${students[i]["id"]})"
            >
              Delete
            </button>

          </div>
        </td>

      </tr>
    `;
  }

  $("tbody").html(tbodyContent);

  $("nav").remove();

  if (students.length != 0) {
    $("body").append(preparePagination(response));
  }
}

function preparePagination(data) {
  let students = data.data;

  if (students.length != 0) {
    let prepareLI = "";

    let pagesNumber = Math.ceil(data.total / 10);

    let prevPageNumber =
      data.currentPage > 1 ? data.currentPage - 1 : data.currentPage;

    let nextPageNumber =
      data.currentPage < pagesNumber ? data.currentPage + 1 : data.currentPage;

    let isNextPageDisabled = data.currentPage < pagesNumber ? "" : "disabled";

    let isPrevPageDisabled = data.currentPage > 1 ? "" : "disabled";

    for (let i = 1; i <= pagesNumber; i++) {
      let isActive = data.currentPage == i ? "active" : "";

      prepareLI += `
        <li class="page-item">
          <a
            class="page-link ${isActive}"
            onclick="changePage(${i})"
            data-page="${i}"
          >
            ${i}
          </a>
        </li>
      `;
    }

    return `
      <nav aria-label="Page navigation example">
        <ul class="pagination">

          <li class="page-item">
            <a
              class="page-link ${isPrevPageDisabled}"
              onclick="changePage(${prevPageNumber})"
              data-page="${prevPageNumber}"
            >
              Previous
            </a>
          </li>

          ${prepareLI}

          <li class="page-item">
            <a
              class="page-link ${isNextPageDisabled}"
              onclick="changePage(${nextPageNumber})"
              data-page="${nextPageNumber}"
            >
              Next
            </a>
          </li>

        </ul>
      </nav>
    `;
  }

  return "";
}

function changePage(page) {
  $("#ChangePage").val(page);

  $("#searchForm").trigger("submit");
}
