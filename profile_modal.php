<div class="profile-modal" id="profile-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="wrapper">
            <h3 class="title">Profile</h3>
            <div class="profile">
                <?php
                $profile_query = mysqli_query($db, "select * from users where u_id='" . $_SESSION['user_id'] . "' ");
                $profile = mysqli_fetch_array($profile_query);
                echo '<h5>' . $profile['f_name'] . ' ' . $profile['l_name'] . '</h5>';
                echo '<h6>' . $profile['email'].'</h6>';
                echo '<h6>' . $profile['phone'].'</h6>';
                echo '<h6>' . $profile['address'].'</h6>';?>
            </div>
            <div class="btn-group">
                <button class="btn theme-btn" onclick="location.href = './update_profile.php';">Update</button>
                <button class="btn theme-btn" onclick="location.href = './update_password.php';">Change Password</button>
            </div>
        </div>
    </div>
</div>