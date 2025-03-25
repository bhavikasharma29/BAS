<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
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
        width: 600px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
      }
      h2 {
        color: #2a2a2a;
      }
      table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }
      th {
        background: #007bff;
        color: white;
      }
      .view-button {
        padding: 5px 10px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
      }
      .view-button:hover {
        background: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <!-- <h2>Doctor's Dashboard</h2> -->
      <h2>Uploaded Prescriptions</h2>
      <table>
        <thead>
          <tr>
            <th>File Name</th>
            <th>Date & Time Issued</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="fileList"></tbody>
      </table>
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
                <tr>
                  <td>
                    <a href="${file.file_path}" target="_blank" title="${file.file_name}">
                      ${file.file_name.length > 30 ? file.file_name.substring(0, 30) + '...' : file.file_name}
                    </a>
                  </td>
                  <td>${new Date(file.uploaded_at).toLocaleString()}</td>
                  <td>
                    <button class="view-button" onclick="viewFile('${file.file_path}')">View</button>
                  </td>
                </tr>`;
              fileList.insertAdjacentHTML("beforeend", fileHTML);
            });
          })
          .catch((error) => console.error("Error fetching files:", error));
      }

      function viewFile(filePath) {
        window.open(filePath, "_blank");
      }

      fetchPrescriptions();
    </script>
  </body>
</html>
