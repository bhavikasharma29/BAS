<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor's Dashboard</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
      }
      body {
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .container {
        width: 500px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
      }
      h2 {
        color: #2a2a2a;
      }
      .file-list {
        margin-top: 20px;
      }
      .file-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #e9f0ff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
      }
      .file-item a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
      }
      .file-item button {
        padding: 5px 10px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin-left: 5px;
      }
      .file-item button:hover {
        background: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2>Doctor's Dashboard</h2>
      <h3>Prescriptions for Student</h3>
      <div class="file-list" id="fileList"></div>
    </div>

    <script>
      function fetchPrescriptions() {
        fetch("fetch_files.php")
          .then((response) => response.json())
          .then((files) => {
            const fileList = document.getElementById("fileList");
            fileList.innerHTML = "";
            files.forEach((file) => {
              let fileHTML = `
                <div class="file-item">
                  <a href="${file.file_path}" target="_blank">${file.file_name}</a>
                  <button onclick="downloadFile('${file.file_path}', '${file.file_name}')">Download</button>
                  <button onclick="viewFile('${file.file_path}')">View</button>
                </div>`;
              fileList.insertAdjacentHTML("beforeend", fileHTML);
            });
          })
          .catch((error) => console.error("Error fetching files:", error));
      }

      function downloadFile(filePath, fileName) {
        const link = document.createElement("a");
        link.href = filePath;
        link.setAttribute("download", fileName);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }

      function viewFile(filePath) {
        window.open(filePath, "_blank");
      }

      fetchPrescriptions();
    </script>
  </body>
</html>
