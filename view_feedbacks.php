<?php
include 'db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM feedbacks ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Feedbacks</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- DataTables CSS & Export Buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

  <style>
    html, body {
      height: 100%;
    }
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0; padding: 0;
      background: #f0f4f8;
      display: flex; flex-direction: column;
      align-items: center;
      transition: background 0.3s, color 0.3s;
    }
    h2 {
      margin-top: 20px;
      font-size: 32px;
      text-align: center;
    }
    .theme-selector, .subject-filter {
      margin: 10px;
    }
    label {
      font-weight: bold;
      font-size: 18px;
    }
    select {
      padding: 10px 14px;
      font-size: 16px;
      border-radius: 6px;
      margin-left: 10px;
    }
    .table-container {
      width: 95%;
      padding: 0 10px;
      overflow-x: auto;
    }
    table {
      width: 100%;
      max-width: 1200px;
      margin: 20px auto;
      border-collapse: collapse;
      font-size: 18px;
    }
    th, td {
      padding: 18px;
      text-align: left;
      border: 1px solid #ccc;
    }
    th {
      background-color: #007bff;
      color: white;
      font-size: 19px;
    }
    tr:nth-child(even) { background-color: #f9f9f9; }

    /* Themes */
    body.light { background: #f2f6ff; color: #000; }
    body.dark { background: #121212; color: #ffffff; }
    body.dark table, body.dark th, body.dark td {
      background-color: #1c1c1c;
      color: #ffffff;
      border-color: #555;
    }
    body.dark th { background-color: #00aaff; }
    body.pink { background: #ffe6f0; color: #880e4f; }
    body.green { background: #e0f2f1; color: #004d40; }
    body.skyblue { background: #e0f7fa; color: #01579b; }
    body.skyblue th {
      background-color: #0288d1;
      color: white;
    }
    body.skyblue td { border-color: #40c4ff; }

    .dt-buttons {
      margin: 20px 0;
    }
    .dt-button {
      background-color: #007bff !important;
      color: white !important;
      border: none;
      padding: 12px 18px;
      font-size: 16px;
      margin-right: 12px;
      border-radius: 6px;
      cursor: pointer;
    }
    .dt-button:hover {
      background-color: #0056b3 !important;
    }

    footer {
      margin-top: auto;
      text-align: center;
      padding: 20px;
      font-size: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body class="light">

  <div class="theme-selector">
    <label for="theme">🎨 Theme:</label>
    <select id="theme" onchange="changeTheme(this.value)">
      <option value="light">🌞 Light</option>
      <option value="dark">🌙 Dark</option>
      <option value="pink">💖 Pink</option>
      <option value="green">🟢 Green</option>
      <option value="skyblue">☁️ Sky Blue</option>
    </select>
  </div>

  <div class="subject-filter">
    <label for="subjectFilter">📚 Filter by Subject:</label>
    <select id="subjectFilter" onchange="filterSubject(this.value)">
      <option value="">All Subjects</option>
      <option value="C">C</option>
      <option value="Python">Python</option>
      <option value="Java">Java</option>
      <option value="DBMS">DBMS</option>
      <option value="Web Development">Web Development</option>
    </select>
  </div>

  <h2>📋 Submitted Feedbacks</h2>
  <div class="table-container">
    <table id="feedbackTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Roll No</th>
          <th>Subject</th>
          <th>Rating</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['rollno']); ?></td>
          <td><?php echo htmlspecialchars($row['subject']); ?></td>
          <td><?php echo $row['rating']; ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['comments'])); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <footer>
    <span style="color: red;">Developed By</span>
    <span style="color: #007bff;"> Bingi Raju 💻</span>
  </footer>

  <script>
    function changeTheme(theme) {
      document.body.className = theme;
    }

    function filterSubject(subject) {
      const table = $('#feedbackTable').DataTable();
      table.column(3).search(subject).draw();
    }

    $(document).ready(function () {
      $('#feedbackTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excelHtml5', 'pdfHtml5', 'print']
      });
    });
  </script>

</body>
</html>
