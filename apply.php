<?php
$pageClass = 'apply-page';
require_once 'header.inc';
?>

<section class="hero hero-apply">
    <h2>Submit Your Expression of Interest</h2>
    <p>Take the next step toward joining Glitzers. Fill out the form below and our recruitment team will review your application.</p>
</section>

<main>
    <h2 id="main-title">Application Form</h2>

    <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post" class="form-card" aria-labelledby="main-title">

        <div class="form-row">
            <div class="col">
                <label for="jobRef">Job Reference</label>
                <select id="jobRef" name="jobRef" required>
                    <option value="" disabled selected>Select a job reference</option>
                    <option value="GA102" <?php if(!empty($_GET['jobRef']) && $_GET['jobRef']==='GA102') echo 'selected'; ?>>GA102</option>
                    <option value="FD215" <?php if(!empty($_GET['jobRef']) && $_GET['jobRef']==='FD215') echo 'selected'; ?>>FD215</option>
                    <option value="CE301" <?php if(!empty($_GET['jobRef']) && $_GET['jobRef']==='CE301') echo 'selected'; ?>>CE301</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" maxlength="20" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ' -]+$" title="Letters, hyphens, apostrophes and spaces allowed; max 20" aria-describedby="firstNameHelp" aria-required="true" required>
                <span id="firstNameHelp" class="sr-only">First name: letters allowed, may include hyphen or apostrophe, maximum 20 characters.</span>
            </div>
            <div class="col">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" maxlength="20" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ' -]+$" title="Letters, hyphens, apostrophes and spaces allowed; max 20" aria-describedby="lastNameHelp" aria-required="true" required>
                <span id="lastNameHelp" class="sr-only">Last name: letters allowed, may include hyphen or apostrophe, maximum 20 characters.</span>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="dob">Date of Birth</label>
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$" title="Enter date in dd/mm/yyyy format" aria-describedby="dobHelp" aria-required="true" required>
                <span id="dobHelp" class="sr-only">Date of birth format: dd slash mm slash yyyy.</span>
            </div>
            <div class="col">
                <fieldset aria-labelledby="genderLegend">
                    <legend id="genderLegend">Gender</legend>
                    <input type="radio" id="genderMale" name="gender" value="Male" required aria-required="true">
                    <label for="genderMale">Male</label>
                    <input type="radio" id="genderFemale" name="gender" value="Female">
                    <label for="genderFemale">Female</label>
                    <input type="radio" id="genderOther" name="gender" value="Other">
                    <label for="genderOther">Other</label>
                </fieldset>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" maxlength="254" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Enter a valid email address" aria-describedby="emailHelp" aria-required="true" required>
                <span id="emailHelp" class="sr-only">Enter a valid email address, for example user@example.com.</span>
            </div>
            <div class="col">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" inputmode="tel" pattern="(?=(?:.*\d){8,12}$)[\d ]+" title="8 to 12 digits; spaces allowed" aria-describedby="phoneHelp" aria-required="true" required>
                <span id="phoneHelp" class="sr-only">Phone may include spaces; must contain between 8 and 12 digits.</span>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="street">Street Address</label>
                <input type="text" id="street" name="street" maxlength="40" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="suburb">Suburb/Town</label>
                <input type="text" id="suburb" name="suburb" maxlength="40" required>
            </div>
            <div class="col">
                <label for="state">State</label>
                <select id="state" name="state" aria-required="true" required>
                    <option value="" disabled selected>Select</option>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select>
            </div>
            <div class="col">
                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" pattern="^[0-9]{4}$" inputmode="numeric" title="Enter a 4-digit postcode" required>
            </div>
        </div>

        <fieldset aria-labelledby="skillsLegend" aria-describedby="skillsHelp">
            <legend id="skillsLegend">Required technical skills (select at least one)</legend>
            <div class="checkbox-row">
                <input type="checkbox" id="skillsTeamwork" name="skills[]" value="Teamwork">
                <label for="skillsTeamwork">Teamwork</label>

                <input type="checkbox" id="skillsCommunication" name="skills[]" value="Communication">
                <label for="skillsCommunication">Communication</label>

                <input type="checkbox" id="skillsProgramming" name="skills[]" value="Programming">
                <label for="skillsProgramming">Programming</label>

                <input type="checkbox" id="skillsProblemSolving" name="skills[]" value="Problem Solving">
                <label for="skillsProblemSolving">Problem Solving</label>
            </div>
            <span id="skillsHelp" class="sr-only">Select at least one technical skill.</span>
        </fieldset>

        <div class="form-row">
            <div class="col">
                <label for="otherSkills">Other Skills (optional)</label>
                <textarea id="otherSkills" name="otherSkills" maxlength="1000"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
</main>

<script>
// Client-side helpers: enforce at least one skills checkbox is checked
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.apply-page .form-card') || document.querySelector('.form-card');
  const skills = Array.from(document.querySelectorAll('input[name="skills[]"]'));

  function validateSkills() {
    const any = skills.some(cb => cb.checked);
    if (!any) {
            skills[0].setCustomValidity('Please select at least one technical skill');
            skills[0].setAttribute('aria-invalid', 'true');
    } else {
            skills[0].setCustomValidity('');
            skills[0].setAttribute('aria-invalid', 'false');
    }
  }

  validateSkills();
  skills.forEach(cb => cb.addEventListener('change', validateSkills));

  if (form) {
    form.addEventListener('submit', function(e) {
      validateSkills();
      if (!form.checkValidity()) {
        // let browser show validation messages
        return;
      }
      // otherwise allow submit
    });
  }
});
</script>

<?php require_once 'footer.inc'; ?>
