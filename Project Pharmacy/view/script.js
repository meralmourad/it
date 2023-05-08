function validateForm(form){
    var valid = true;

    var Pass = form.password.value, Passconfirm = form.confirm.value;

    if(Pass !== Passconfirm){
        document.getElementById("passError").innerHTML = "password does not match";
        valid = false;
    }

    return valid;
}
function showForm(){
  document.getElementById("formPass").style.display = "block";
}
function confirmDeleteUser($id) {
  if (confirm('Are you sure you want to delete this user?')) {
      window.location.href = '../../php/users/deleteUser.php?id=' + $id;
  }
}
function confirmDeleteProduct($id) {
  if (confirm('Are you sure you want to delete this product?')) {
      window.location.href = '../../php/products/deleteProduct.php?id=' + $id;
  }
}