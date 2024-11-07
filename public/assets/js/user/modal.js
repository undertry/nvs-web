document.getElementById('user-icon').onclick = function () {
    document.getElementById('userModal').style.display = "block";
}

document.querySelector('.close').onclick = function () {
    document.getElementById('userModal').style.display = "none";
}

window.onclick = function (event) {
    if (event.target == document.getElementById('userModal')) {
        document.getElementById('userModal').style.display = "none";
    }
}