<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <style>
      .contact-section {
        background-color: #f4f4f4;
        padding: 50px 20px;
        text-align: center;
      }
      .contact-section h2 {
        margin-bottom: 20px;
        font-size: 2.5rem;
        color: #333;
      }
      .contact-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        max-width: 600px;
        text-align: left;
      }
      .contact-info p {
        margin: 10px 0;
        font-size: 1.2rem;
        color: #555;
      }
      .contact-info a {
        color: #1a73e8;
        text-decoration: none;
      }
      .contact-info a:hover {
        text-decoration: underline;
      }
      body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        border-bottom: solid 2px rgb(4, 138, 24);
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
      nav .brand {
        font-weight: bolder;
      }
      nav ul a {
        text-decoration: none;
        color: rgb(6, 67, 28);
        padding: 0.5rem 1rem;
      }
      nav ul .active {
        text-decoration: underline;
      }
      .main-section {
        margin: 2rem;
      }
      .hero {
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
        text-decoration: none;
        border-radius: 5px;
        color: white;
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
    <nav>
      <div class="brand">
        SMART <span style="color: green">ONLINE</span> VOTE
      </div>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="./ndex.php">Login</a></li>
        <li><a href="./votter/register.php">signup</a></li>
        <li><a href="../index.php#contact">Contact</a></li>
      </ul>
    </nav>

    <section class="hero" id="home">
      <div>
        <h2>Error</h2>
        <p>
          Your account is not yet Approved contact admin to approve account.
        </p>
        <a href="../index.html">Back to home</a>
      </div>
    </section>
    <footer>
      <p>&copy; 2024 Welcome Page. All Rights Reserved.</p>
    </footer>
  </body>
</html>
