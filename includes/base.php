<?php
    include "head_links.php";
    ?>
<div class="nav">
      <div class="emblem">
        <a href="../testAnimationLandingPage/main.html">
          <img class="logo" src="../img/favicon.png" alt="logo" />
        </a>
      </div>
      <div class="widgets">
        <div class="home">
          <a href="../Page2/page2.html">
            <img src="../img/home.svg" alt="" />
          </a>
        </div>
        <div class="chat">
          <a href="../chatPage/chat.php">
            <img src="../img/chat.svg" alt="" />
          </a>
        </div>
        <div class="heart">
          <a href="../match-page/match.php">
            <img src="../img/heart.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="notification">
          <img src="../img/notification.svg" alt="" id="modalactive" onclick="opcl()"/>
      </div>
      <div class="profile">
        <a href="../profilepage/profile.html">
          <img class="profileimg" src="../img/profile.jpg" alt="profile-img" />
        </a>
      </div>
    </div>
    <div id="modal">
      <div id="overlay">
        <img src="../img/cross.svg" alt="cancel" id="modalinactive" />
      </div>
    </div>
    <script>
      function opcl() {
        let x = document.getElementById("modal");
        if (x.style.display === "none") {
          x.style.display = "block";
          // let button = document.getElementById("modalactive");
          // button.addEventListener("click", openModal);
        } else {
          x.style.display = "none";
        }
      }

      let close = document.getElementById("modalinactive");
      close.addEventListener("click", closeModal);

      // function openModal() {
      //   modal.style.display = "block";
      // }

      function closeModal() {
        modal.style.display = "none";
      }
      window.addEventListener("keydown", (event) => {
        if (event.code === "Escape") {
          modal.style.display = "none";
        }
      });
    </script>