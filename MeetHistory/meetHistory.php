<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Prescription</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        .PriscriptionWrapper {
    max-width: 900px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    text-align: center;
  }
  
  /* h2 {
    font-size: 24px;
    color: #5e6a75;
    margin-bottom: 20px;
    font-weight: 600;
  } */
  
  /*  Form Styling */
  .PriscriptionWrapper form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .PriscriptionWrapper label {
    text-align: left;
    font-size: 14px;
    color: #555;
    font-weight: 500;
  }
  
  input[type="text"],
  input[type="date"],
  textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }
  
  .PriscriptionWrapper textarea {
    resize: vertical;
    height: 100px;
  }
  
  .PriscriptionWrapper button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  
  .PriscriptionWrapper button:hover {
    background-color: #45a049;
  }
  
  .PriscriptionWrapper button:focus {
    outline: none;
  }
  
  /* Prescription Table/Preview */
  .prescription-table {
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
  }
  
  .prescription-table th,
  .prescription-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
  }
  
  .prescription-table th {
    background-color: #f0f0f0;
    font-weight: bold;
  }
  
  /* Prescription Card Styles (For student dashboard) */
  .prescription-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px;
    padding: 20px;
  }
  
  .prescription-card a {
    color: #007BFF;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
  }
  
  .prescription-card a:hover {
    text-decoration: underline;
  }
  
  /* Prescription List on Dashboard */
  .prescription-list {
    margin-top: 20px;
  }
  
  .prescription-item {
    background-color: #fff;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .prescription-item a {
    font-size: 16px;
    font-weight: 600;
    color: #4CAF50;
    text-decoration: none;
  }
  
  .prescription-item a:hover {
    text-decoration: underline;
  }
  
  .prescription-item .delete-btn {
    background-color: #FF4D4D;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .prescription-item .delete-btn:hover {
    background-color: #e44d4d;
  }
    </style>
</head>
<body>
    <div class="PriscriptionWrapper">
        <div id="header">
            <a href="#"><img src="images/logo.jpg" class="logo" alt=""></a>
            <h2>Digital Prescription</h2>
        </div>
       
        <form id="prescription-form">
            <label style="padding-top: 10px;">Date:</label>
            <input type="date" id="date" required>
            
            <label>Problem:</label>
            <input type="text" id="problem" required>
            
            <label>Prescription:</label>
            <textarea id="prescription" required></textarea>
            
            <label>Medicines:</label>
            <textarea id="medicines" required></textarea>
            
            <label>Blood Pressure (Optional):</label>
            <input type="text" id="bp">
            
            <label>Doctor’s Name:</label>
            <input type="text" id="doctor-name" required>
            
            <label>Doctor’s ID:</label>
            <input type="text" id="doctor-id" required>
            
            <button type="button" id="generate-prescription">Generate Prescription</button>
        </form>
    </div>

    <script>
        document.getElementById("generate-prescription").addEventListener("click", function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const date = document.getElementById("date").value;
            const problem = document.getElementById("problem").value;
            const prescription = document.getElementById("prescription").value;
            const medicines = document.getElementById("medicines").value;
            const bp = document.getElementById("bp").value || "Not Provided"; // Default if empty
            const doctorName = document.getElementById("doctor-name").value;
            const doctorID = document.getElementById("doctor-id").value;

            if (!date || !problem || !prescription || !medicines || !doctorName || !doctorID) {
                alert("Please fill all mandatory fields!");
                return;
            }

            // PDF Layout
            doc.setFont("helvetica", "bold");
            doc.setFontSize(16);
            doc.text("Digital Prescription", 80, 10);
            
            doc.setFontSize(12);
            doc.setFont("helvetica", "normal");
            doc.text(`Date: ${date}`, 10, 20);
            doc.text(`Doctor: ${doctorName} (ID: ${doctorID})`, 10, 30);
            doc.text(`Problem: ${problem}`, 10, 40);
            doc.text("Prescription:", 10, 50);
            doc.text(prescription, 10, 60, { maxWidth: 180 });

            doc.text("Medicines:", 10, 90);
            doc.text(medicines, 10, 100, { maxWidth: 180 });

            doc.text(`Blood Pressure: ${bp}`, 10, 130);

            // Save the file
            const fileName = `Prescription_${doctorID}_${Date.now()}.pdf`;
            doc.save(fileName);
            
            // Convert PDF to Blob and Upload
            uploadPrescription(fileName, doc.output("blob"), doctorID, doctorName);
        });

        function uploadPrescription(fileName, fileData, doctorID, doctorName) {
            let formData = new FormData();
            formData.append("fileName", fileName);
            formData.append("file", fileData, fileName);
            formData.append("doctor_id", doctorID);
            formData.append("doctor_name", doctorName);

            console.log("Sending Data:", {
                fileName: fileName,
                doctorID: doctorID,
                doctorName: doctorName
            }); // Debugging Log

            fetch("upload_prescription.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(result => console.log("Server Response:", result)) // Debugging Log
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>

    
        

    