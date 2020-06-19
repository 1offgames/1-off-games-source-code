function validationAddProduct() {
  let title = document.getElementById('title').value;
  let desc = document.getElementById('desc').value;
  const testQuery = /\w/g;

  title = title.replace(/\s/g, '-');
  title = title.replace(/[^A-Za-z0-9\-]/g, '');

  desc = desc.replace(/\s/g, '-');
  desc = desc.replace(/[^A-Za-z0-9\-]/g, '');

  if (title === '' || !testQuery.test(title)) {
    alert('Adding product failed: invalid title');
    return false;
  }
  if (desc === '' || !testQuery.test(desc)) {
    alert('Adding product failed: invalid description');
    return false;
  }
  return true;
}

function validationAddUser() {
  const password = document.getElementById('password').value;
  const passwordRE = document.getElementById('passwordRe').value;
  let postalCode = document.getElementById('userPostal').value;
  const testQuery = /[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]/;

  postalCode = postalCode.toUpperCase();

  if (password !== passwordRE) {
    alert("Password doesn't match confirmation.");
    return false;
  }
  if (!testQuery.test(postalCode)) {
    alert('Invalid Canadian Postal Code');
    return false;
  }
  return true;
}

// Runs validationAddUser first and will disable modal popup if it returns false.
function validateBeforePrivacyPolicy() {
  if (validationAddUser()) {
    document.getElementById('continueBtn').setAttribute("data-target", "#privacyModal");
  } else
    document.getElementById('continueBtn').setAttribute("data-target", "");
}

function validationUpdateUser() {
  let postalCode = document.getElementById('userPostal').value;

  if (postalCode == '') {
    return true;
  }

  const testQuery = /[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]/;
  postalCode = postalCode.toUpperCase();

  if (!testQuery.test(postalCode)) {
    alert('Invalid Canadian Postal Code');
    return false;
  }
  return true;
}
