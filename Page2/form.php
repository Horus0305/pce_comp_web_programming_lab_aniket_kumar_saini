<link rel="stylesheet" href="css/proCom.css" />

<div id="profile_completion_popup" class="profile_completion_popup">
    <section class="container">
        <header>Profile Completion</header>
        <i onclick="gaayab(this.id)" id="cross" class="fi fi-rr-cross cross"></i>
        <form class="form" action="page2.php" method="post">
            <div class="input-box">
                <label>Full Name <span id="name_error" class="error">*Full name can only contain letters and
                        spaces</span></label>
                <input required="" id="fullName" name="full_name" placeholder="Enter full name" type="text">
            </div>
            <div class="column">
                <div id="phone" class="input-box">
                    <label>Phone Number <span id="phone_error" class="error">*Phone number must be 10
                            digits</span></label>
                    <input required="" id="phoneNumber" name="number" placeholder="Enter phone number" type="telephone">
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input id="birthDate" required="" name="birth_date" placeholder="Enter birth date" type="date">
                </div>
            </div>
            <div class="gender-box">
                <label>Gender</label>
                <div class="gender-option">
                    <div class="gender">
                        <input checked="" name="gender" id="check-male" type="radio">
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input name="gender" id="check-female" type="radio">
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input name="gender" id="check-other" type="radio">
                        <label for="check-other">Prefer not to say</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label>Address</label>
                <input name="address" id="address" required="" placeholder="Enter street address" type="text">
                <div class="column">
                    <div class="select-box">
                        <select>
                            <option hidden="">Country</option>
                            <option>India</option>
                            <option>USA</option>
                            <option>UK</option>
                            <option>Germany</option>
                            <option>Japan</option>
                        </select>
                    </div>
                    <input id="city" required="" name="city" placeholder="Enter your city" type="text">
                </div>
            </div>
            <button name="submit" onclick="profile_sub()">Submit</button>
        </form>

    </section>
</div>