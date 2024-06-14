<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Acount not Approved</title>
    <style>
      body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      header {
        background-color: #ffffff;
        color: white;
        padding: 1rem 0;
      }
      header .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: auto;
        padding: 0 1rem;
      }
      header h1 {
        margin: 0;
      }
      nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
      }
      nav ul li {
        margin-left: 2rem;
      }
      nav ul li a {
        color: black;
        text-decoration: none;
      }
      .hero {
        background: url("https://via.placeholder.com/1200x600") no-repeat center
          center/cover;
        height: 600px;
        color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
      }
      .hero h2 {
        font-size: 3rem;
        margin: 0;
      }
      .hero p {
        font-size: 1.5rem;
        margin: 1rem 0;
      }
      .hero a {
        display: inline-block;
        margin-top: 1rem;
        padding: 1rem 2rem;
        background-color: green;
        color: white;
        text-decoration: none;
        border-radius: 5px;
      }
      footer {
        border-top: solid 1px rgb(8, 31, 2);
        background-color: white;
        color: rgb(8, 31, 2);
        text-align: center;
        padding: 1rem 0;
        position: fixed;
        width: 100%;
        bottom: 0;
      }
    </style>
  </head>
  <body>
    <header>
      <div class="container">
        <h1>Accont Not Approved</h1>
        <nav>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="./public/index.php">Login</a></li>
            <li><a href="./public/votter/register.php">signup</a></li>
            <li><a href="#contuct">Contact</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="hero" id="home">
      <div>
        <h2>Error</h2>
        <p>
          Your account is not yet Approved contact admin to approve account.
        </p>
        <a href="../index.php">Back to home</a>
      </div>
    </section>
    <footer>
      <p>&copy; 2024 Welcome Page. All Rights Reserved.</p>
    </footer>
  </body>
</html>
