<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="books.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="functions.js"></script>
  </head>
  <body>
    <?php
      readFile('advSearch.html');
    ?>
    <div class="adv-search">
      <div class="overlap-wrapper">
        <div class="overlap">
          <div class="copywright-footer">
            <div class="overlap-group">
              <img class="background" src="img/background.png" />
              <div class="copyrights"></div>
              <p class="text-wrapper">Copyright © 1996-2016 Company Co. All rights reserved</p>
            </div>
          </div>
          <div class="footer">
            <img class="layer" src="img/layer-20.png" />
            <div class="e-lib">
              <div class="div">
                <div class="news-feed-careers"><br />News Feed<br />Careers<br />Contact Us<br />Privacy Policy</div>
                <div class="text-wrapper-2">E-Library</div>
              </div>
            </div>
            <div class="track">
              <div class="div">
                <p class="p"><br />Featured Products<br />Future Products<br />Our Mission<br />Customer Stories</p>
                <div class="text-wrapper-3">Track</div>
              </div>
            </div>
            <div class="book">
              <div class="overlap-2">
                <p class="p"><br />Find a Book<br />Area of Intrest<br />Course by Terms</p>
                <div class="text-wrapper-4">Book</div>
              </div>
            </div>
          </div>
          <div class="find">
            <div class="ebook">
              <div class="ebook-text">
                <p class="COURSE-MATERIALS">COURSE MATERIALS FROM ONE <br />CONVENIENT PLACE</p>
                <div class="text-wrapper-5">ACCESS ALL YOUR DIDGITAL</div>
                <div class="text-wrapper-6">E- LIBRARY</div>
              </div>
            </div>
            <div class="track-text-wrapper">
              <div class="track-text">
                <p class="OF-THE-WAY-WITH-OUR">OF THE WAY WITH OUR <br />TRAKING TOOL</p>
                <p class="text-wrapper-7">FOLLOW YOUR ORDERS EVERY STEP</p>
                <div class="TRACK-ORDORS">TRACK <br />ORDORS</div>
              </div>
            </div>
            <div class="BOOK-text-wrapper">
              <div class="BOOK-text">
                <p class="text-wrapper-8">TO HELP YOU WITH YOUR CLASSES</p>
                <p class="text-wrapper-9">FIND MORE THAN 50+ BOOK TITLES</p>
                <div class="BOOK-text-2">BOOK</div>
              </div>
            </div>
            <div class="text">
              <p class="GET-ALL-YOU-NEED-FOR">
                GET ALL YOU NEED FOR CLASS WITH NEW YORK INSTITUTE OF TECHNOLOGY.<br />YOUR ACADEMIC SUCCESS IS OUR
                PRIORITY
              </p>
              <p class="text-wrapper-10">FIND WHAT YOU ARE LOOKING FOR</p>
            </div>
          </div>
          <div class="top">
            <div class="overlap-3">
              <div class="top-links">
                <div class="links">
                  <div class="home"><div class="text-wrapper-11">Home</div></div>
                  <div class="interest"><div class="text-wrapper-11">Interest</div></div>
                  <div class="course"><div class="text-wrapper-11">Course</div></div>
                  <a href="cart.html"><div class="cart"></div></a>
                  <img class="big-logo" src="img/big-logo.png" />
                </div>
              </div>
              <div class="advance-search">
                <div class="advance-scrolldown">
                  <div class="div-wrapper"><button class="text-wrapper-12" onclick="searchModal();">Advanced Search</button></div>
                </div>
              </div>
              <form action="results.php" method="post">
                <div class="search-bar">
                  <input class="text-wrapper-13" type="text" name="searchInput" placeholder="Search by Book Title">
                  <input type="image" class="img" src="img/layer-2-1.png" alt="Submit" value="inputSearch"/>
                </div>
              </form>
            </div>
          </div>
          <div class="lable">
            <div class="overlap-4">
              <div class="text-wrapper-15">Results</div>
              <div class="rectangle"></div>
            </div>
            <?php
              $major = $_POST['major'] ?? 'default';
              $diff = $_POST['diff'] ?? 'default';
              $userInput = $_POST['searchInput'] ?? null;
              $pdo = new PDO('sqlite:bookWise.db');
              $statement;
              $books = [];
              $sql;
              $maj_result = 'Selected Major(s): ';
              $diff_result = 'Selected Level(s): ';
              $your_query = '';

              if ($userInput != null) {
                $sql = 'SELECT * FROM Textbooks WHERE book_Title LIKE :userInput';
                $statement = $pdo->prepare($sql);
                $statement->bindValue(':userInput', '%' . $userInput . '%');
                $statement->execute();
                $books = $statement->fetchAll(PDO::FETCH_ASSOC);
                $your_query = 'Your query: ' . $userInput . '; &nbsp;&nbsp;&nbsp;';
                $maj_result = $maj_result . 'None';
                $diff_result = $diff_result . 'None';

              } else if ($major != 'default' && $diff == 'default') {      // Major is selected but not level
                $sql = 'SELECT * FROM Textbooks WHERE book_Major = :selectedMajor';
                $statement = $pdo->prepare($sql);
                for ($i = 0; $i < count($major); $i++) {
                  $selectedMajor = $major[$i];
                  if ($i > 0) {
                    $maj_result = $maj_result . ', ';
                  } 
                  $maj_result = $maj_result . $selectedMajor;
                  $statement->bindParam(':selectedMajor', $selectedMajor);
                  $statement->execute();
                  $temp = $statement->fetchAll(PDO::FETCH_ASSOC);
                  $books = array_merge($books, $temp);
                }
                $diff_result = $diff_result . 'None';

              } else if ($major == 'default' && $diff != 'default') {     // Level is selected but not major
                $sql = 'SELECT * FROM Textbooks WHERE book_level = :selectedLevel';
                $statement = $pdo->prepare($sql);
                for ($j = 0; $j < count($diff); $j++) {
                  $selectedLevel = $diff[$j];
                  if ($j > 0) {
                    $diff_result = $diff_result . ', ';
                  } 
                  $diff_result = $diff_result . $selectedLevel;
                  $statement->bindParam(':selectedLevel', $selectedLevel);
                  $statement->execute();
                  $temp = $statement->fetchAll(PDO::FETCH_ASSOC);
                  $books = array_merge($books, $temp);
                }
                $maj_result = $maj_result . 'None';

              } else if ($major != 'default' && $diff != 'default') {     // Both major and level are selected
                $maj_result = 'Selected Major(s): ';
                $diff_result = 'Selected Level(s): ';
                $sql = 'SELECT * FROM Textbooks WHERE book_Major = :selectedMajor AND book_level = :selectedLevel';
                $statement = $pdo->prepare($sql);
                for ($k = 0; $k < count($major); $k++) {
                  $selectedMajor = $major[$k];
                  if ($k > 0) {
                    $maj_result = $maj_result . ', ';
                  }
                  $maj_result = $maj_result . $selectedMajor;
                  for ($l = 0; $l < count($diff); $l++) {
                    $selectedLevel = $diff[$l];
                    if ($k == 0) {
                      if ($l > 0) {
                        $diff_result = $diff_result . ', ';
                      } 
                      $diff_result = $diff_result . $selectedLevel;
                    }
                    $statement->bindParam(':selectedMajor', $selectedMajor);
                    $statement->bindParam(':selectedLevel', $selectedLevel);
                    $statement->execute();
                    $temp = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $books = array_merge($books, $temp);
                  }
                }
              } else {      // Neither major nor level are selected
                $maj_result = $maj_result . 'None';
                $diff_result = $diff_result . 'None';
              }
              $maj_result = $maj_result . '; &nbsp;&nbsp;&nbsp;';
              $diff_result = $diff_result . '; &nbsp;&nbsp;&nbsp;';
              
              echo '<div class="results">' . $your_query . $maj_result . $diff_result . 'Number of books that matches: ' . 
              count($books) . '</div>';
              foreach($books as $row => $book) {
                echo '<div class="box">';
                echo '<div class="book-preview">';
                echo '<img class="property-rectangle" src="img/Textbooks/' . $book['book_Subject'] . '.jpg" />';
                echo '<div class="property-book"><div class="text-wrapper-30" onclick="openBookModal(' . "'" . $book['book_ISBN'] .
                "'" . ');">' . $book['book_Title'] . '</div></div>';
                echo '<div class="author">Author(s): ' . $book['book_Authors'] . '</div>';
                echo '<div class="property-frame">Rating: ' . $book['book_Rating'] . '/5</div>';
                echo '<div class="property-level">Level: ' . $book['book_level'] . '</div>';
                echo '<div class="major">Major: ' . $book['book_Major'] . '</div>';
                echo '<div class="subject">Subject: ' . $book['book_Subject'] . '</div>';
                echo '<div class="property"><div class="text-wrapper-31">$' . $book['book_Price'] . '</div></div>';
                echo '<div class="property-add-cart">';
                echo '<div class="add-cart"><button id="cart' . $book['book_ISBN'] . '" class="div2" onclick="addToCart(' . "'" . 
                $book['book_Title'] . "', " . $book['book_Price'] . ", '" . $book['book_ISBN'] . "'" . 
                ');">Add to Cart</button></div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div id="' . $book['book_ISBN'] . '" class="modal">';
                echo '<div class="modal-content">';
                echo '<span class="close" onclick="closeBookModal(' . "'" . $book['book_ISBN'] . "'" . ');">&times;</span>';
                echo '<div class="box">';
                echo '<div class="book-page">';
                echo '<img class="property-rectangle" src="img/Textbooks/' . $book['book_Subject'] . '.jpg" />';
                echo '<div class="property-book2"><div class="text-wrapper-32">' . $book['book_Title'] . '</div></div>';
                echo '<div class="author2">Author(s): ' . $book['book_Authors'] . '</div>';
                echo '<div class="property-desc">Description:<br/>' . $book['book_Desc'] . '</div>';
                echo '<div class="property-isbn">ISBN: ' . $book['book_ISBN'] . '</div>';
                echo '<div class="property-edition">Edition: ' . $book['book_Edition'] . '</div>';
                echo '<div class="publisher">Publisher: ' . $book['book_Publisher'] . '</div>';
                echo '<div class="bookYear">Year: ' . $book['book_Year'] . '</div>';
                echo '<div class="property-frame2">Rating: ' . $book['book_Rating'] . '/5</div>';
                echo '<div class="property-level2">Level: ' . $book['book_level'] . '</div>';
                echo '<div class="major2">Major: ' . $book['book_Major'] . '</div>';
                echo '<div class="subject2">Subject: ' . $book['book_Subject'] . '</div>';
                echo '<div class="property2"><div class="text-wrapper-31">$' . $book['book_Price'] . '</div></div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              } 
            ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>