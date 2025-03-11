<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Prescription</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <h2>Digital Prescription</h2>
        <form id="prescription-form">
            <label>Date:</label>
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

    <script >
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

    // Simulate file upload to server
    uploadPrescription(fileName, doc.output("blob"));
});

function uploadPrescription(fileName, fileData) {
    let formData = new FormData();
    formData.append("fileName", fileName);
    formData.append("file", fileData);

    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.error("Error:", error));
}

    </script>
</body>
</html>
