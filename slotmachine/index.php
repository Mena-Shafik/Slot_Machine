<?php
session_start();
?>
<html>
   <!--
   Mena Shafik 
   Created June 1,2015
   Assignment 3
   -->
   <head>
      <title>Slot Machine</title>
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ek+Mukta">
      <link rel="stylesheet" href="css/AS4css.css">
      <style>
         body{
            <?php
            date_default_timezone_set('America/Toronto');
            // time zone correcter
            $timezone = time();
            $sunrise = 6;
            $sunset = 21;
            $thetime = intval(date("H", $timezone));

            // BACKGROUND WILL CHANGE BASED ON TIME
            //background-image: url("images/background1.png");
            if ($thetime > $sunrise && $thetime < $sunset)
            {
               echo 'background-image: url("images/background1.png");';
            } else
            {
               echo 'background-image: url("images/background2.png");';
            }
            ?>

            background-repeat: no-repeat;
            background-size: cover;
            margin: 0px;
         }  
         li {
            float: left;
         }

      </style>
      <?php
      if (isset($_POST["reset"]))
      {
         $_SESSION["bank"] = 100;
      }

      //Vars
      if (isset($_POST["bet"]))
      {
         $bet = $_POST["bet"];
      } else
      {
         $bet = 0;
      }

      if (!isset($_SESSION["bank"]))
      {
         $_SESSION["bank"] = 100;
      }

      function drawFruit($fruit)
      {
         return "<img width=\"180\" height=\"180\" src=\"images/" . $fruit . ".png\" alt=\"" . $fruit . "\" />";
      }
      ?>

   </head>
   <body>
      <div id="wrapper">
         <div id="header">
            <h1 align="center" class="looks"> <p>Slot Machine</p></h1>
            <h2 align="center" class="looks"><p>Take a Spin!</p></h2>
         </div>


         <div id="pics">
            <!-- PICTURES ARE STORED IN AN ARRAY-->
            <?php
            $fruits = array("orange", "apple", "cherry", "lemon", "grapes", "pear", "watermelon");

            $max = count($fruits) - 1;

            $first = $fruits[rand(0, $max)];
            $second = $fruits[rand(0, $max)];
            $third = $fruits[rand(0, $max)];
            // WILL OUTPUT PICUTRES BASED ON A RANDOM VALUE
            echo "<center><p id='slots'>" . drawFruit($first) . drawFruit($second) . drawFruit($third) . "</p></center>";
            ?>
         </div>
         <div > 
            <center>
               <!-- DETERMINES WHAT AND HOW MUCH YOU WIN-->
               <div>
                  <center>
                     <p id="messages">
                        <?php
                        if ($first == "cherry" && $second == "cherry" && $third == "cherry")
                        {
                           $_SESSION["bank"] += $bet * 10;
                           echo "!!!!TRIPLE CHERRY!!!!";
                        } elseif ($first == $second && $second == $third)
                        {
                           $_SESSION["bank"] += $bet * 5;
                           echo "!!Jackpot!!";
                        } elseif ($first == $second || $second == $third || $first == $third)
                        {
                           $_SESSION["bank"] += $bet * 2;
                           echo "You Win!";
                        } else
                        {
                           $_SESSION["bank"] -= $bet;
                           echo "Try Again";
                        }
                        ?>
                  </center>
                  </p>
               </div>
            </center>
         </div> 
         <!-- messages -->
         <div id="control">
            <!-- CHOOSE HOW MUCH TO BET OR TO RESET THE GAME-->
            <center>
               <form action="index.php" method="post" id="lever" >
                  <div id="betSelector"> 

                     <p id="money"> Bank: <?php echo $_SESSION["bank"]; ?> </p>

                     <p id="bet"> Your bet: 

                        <select name="bet">
                           <option>20</option>
                           <option>50</option>
                           <option>100</option>
                           <option>200</option>
                        </select>
                     <div id="spin">
                        <button class="spin" type="submit" name="spin">SPIN</button> 
                     </div>
                  </div> <!-- bet selector --> 
               </form> 
               <form action="index.php" method="post" id="lever">
                  <button type="submit" name="reset" value="1">RESET GAME</button>          
               </form> 
            </center>
         </div> <!-- control --> 
      </div><!-- wrapper -->

      <!-- FOOTER AT THE BOTTOM WITH THE TIME-->
      <div id="footer"> 
         <center>
            <?php
            if ($thetime > $sunrise && $thetime < $sunset)
            {
               echo'<p id="time"><img  src="images/32.png" alt="sun" />';
               echo 'Time: ' . date('h:i A', $timezone);
               echo '<img  src="images/32.png" alt="sun" /></p>';
            } else
            {
               echo'<p id="time"><img  src="images/31.png" alt="sun" />';
               echo 'Time: ' . date('h:i A', $timezone);
               echo '<img  src="images/31.png" alt="sun" /></p>';
            }
            ?>
         </center>
      </div>
   </body>
</html>

