function validateForename(field) {
  return field == "" ? "No Forename was entered.<br>" : "";
}

function validateSurname(field) {
  return field == "" ? "No Surname was entered.<br>" : "";
}

function validateUsername(field) {
  if (field == "") return "No Username was entered.<br>";
  else if (field.length < 5)
    return "Usernames must be at least 5 characters.<br>";
  else if (/[^a-zA-Z0-9_-]/.test(field))
    return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.<br>";
  return "";
}

function validatePassword(field) {
  if (field == "") return "No Password was entered.<br>";
  else if (field.length < 6)
    return "Passwords must be at least 6 characters.<br>";
  else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
    return "Passwords require one each of a-z, A-Z and 0-9.<br>";
  return "";
}

function validateAge(field) {
  if (field == "" || isNaN(field)) return "No Age was entered.<br>";
  else if (field < 18 || field > 110)
    return "Age must be between 18 and 110.<br>";
  return "";
}

function validateEmail(field) {
  if (field == "") return "No Email was entered.<br>";
  else if (
    !(field.indexOf(".") > 0 && field.indexOf("@") > 0) ||
    /[^a-zA-Z0-9.@_-]/.test(field)
  )
    return "The Email address is invalid.<br>";
  return "";
}
