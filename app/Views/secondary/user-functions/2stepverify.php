<title>Enter Code</title>
</head>
<body>
  <div class="form-container">
    <h1>Enter Code</h1>
    <form action="<?= base_url('/confirmcode'); ?>" method="post">
      <label for="code">Verification Code:</label>
      <input type="text" id="code" name="code" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
