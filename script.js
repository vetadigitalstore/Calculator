// পপআপ HTML লোড করা (যদি popup.html অন্য ফোল্ডারে থাকে)
fetch("profile/profile.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("popupContainer").innerHTML = data;
    });

// পপআপ ওপেন ফাংশন
function openPopup(id) {
    document.getElementById(id).style.display = "flex";
}

// পপআপ ক্লোজ ফাংশন
function closePopup(id) {
    document.getElementById(id).style.display = "none";
}

// প্লাস (+) পপআপ লোড
fetch("plus-popup.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("popupContainer").innerHTML += data;
    });

// পপআপ ওপেন ফাংশন
function openPopup(id) {
    document.getElementById(id).style.display = "flex";
}

// পপআপ ক্লোজ ফাংশন
function closePopup(id) {
    document.getElementById(id).style.display = "none";
}