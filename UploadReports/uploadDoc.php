<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>File Upload</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
      }
      body {
        background: #2a2a2a;
        scroll-behavior: auto;
      }
      .wrapper {
        width: 430px;
        margin: 100px auto;
        background: #fff;
        border-radius: 5px;
        padding: 30px;
        box-shadow: 7px 7px 12px rgba(0, 0, 0, 0.05);
        text-align: center;
      }
      .wrapper header {
        color: #2a2a2a;
        font-size: 27px;
        font-weight: 600;
      }
      .wrapper form {
        height: 167px;
        display: flex;
        cursor: pointer;
        margin: 30px 0;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 5px;
        border: 2px dashed #2a2a2a;
        transition: border 0.3s ease;
      }
      form :where(i, p) {
        color: #2a2a2a;
      }
      form i {
        font-size: 50px;
      }
      form p {
        margin-top: 15px;
        font-size: 16px;
      }
      .upload-btn {
        display: none;
        padding: 10px 20px;
        background: #2a2a2a;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
      }
      .uploaded-area .row {
        margin-bottom: 10px;
        background: #e9f0ff;
        padding: 15px 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .uploaded-area i {
        font-size: 20px;
        cursor: pointer;
        color: red;
      }
    </style>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <header>File Uploader</header>
      <form id="uploadForm">
        <input class="file-input" type="file" name="file" hidden />
        <i class="fa-solid fa-file-arrow-up"></i>
        <p>Drag & Drop or Click to Upload</p>
      </form>
      <button class="upload-btn" id="uploadBtn">Upload</button>
      <section class="uploaded-area" id="uploadedArea"></section>
    </div>

    <script>
      const form = document.querySelector("form"),
        fileInput = document.querySelector(".file-input"),
        uploadBtn = document.getElementById("uploadBtn"),
        uploadedArea = document.getElementById("uploadedArea");

      let selectedFile = null;
      const allowedTypes = ["application/pdf", "image/png", "image/jpeg"];

      function fetchUploadedFiles() {
        fetch("fetch_files.php")
          .then((response) => response.json())
          .then((files) => {
            uploadedArea.innerHTML = "";
            files.forEach((file) => {
              let uploadedHTML = `
                <div class="row" id="file-${file.id}">
                  <div class="content">
                    <i class="fas fa-file-alt"></i>
                    <div class="details">
                      <a href="${file.file_path}" target="_blank">${file.file_name}</a>
                    </div>
                  </div>
                  <i class="fas fa-trash-alt" onclick="deleteFile(${file.id})"></i>
                </div>`;
              uploadedArea.insertAdjacentHTML("beforeend", uploadedHTML);
            });
          });
      }

      form.addEventListener("click", () => fileInput.click());

      fileInput.onchange = ({ target }) => {
        let file = target.files[0];
        if (file) {
          if (!allowedTypes.includes(file.type)) {
            alert("Only PDF, PNG, and JPG files are allowed!");
            return;
          }
          selectedFile = file;
          uploadBtn.style.display = "block";
        }
      };

      uploadBtn.addEventListener("click", () => {
        if (selectedFile) {
          uploadFile(selectedFile);
          uploadBtn.style.display = "none";
        }
      });

      function uploadFile(file) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "upload.php");

        xhr.onload = () => {
          if (xhr.status === 200) {
            fetchUploadedFiles(); // Refresh the file list
          }
        };

        let data = new FormData();
        data.append("file", file);
        xhr.send(data);
      }

      function deleteFile(fileId) {
        fetch("delete_files.php?id=" + fileId, { method: "GET" })
          .then((response) => response.json())
          .then((result) => {
            if (result.success) {
              document.getElementById("file-" + fileId).remove();
            } else {
              alert("Failed to delete file.");
            }
          });
      }

      fetchUploadedFiles(); // Load files on page load
    </script>
  </body>
</html>
