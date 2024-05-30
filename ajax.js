function buatPost() {
    var content = document.getElementById("content").value;
    if (content.trim() === "") {
        alert("Post content be empty");
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submitpost.php", true);
    xhr.setRequestHeader("content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            ambilPost();
            document.getElementById("content").value = "";
        }
    };
    xhr.send("content=" + encodeURIComponent(content));
}

function ambilPost() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "getpost.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("post-content").innerHTML = xhr.responseText;
        }
    };
    xhr.send(); 
}

function hapusPost(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "deletePost.php?id=" + encodeURIComponent(id), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            ambilPost();
        }
    };
    xhr.send(); 
}

function likePost(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "likePost.php?id=" + encodeURIComponent(id), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            ambilPost();
        }
    };
    xhr.send();
}

function unlikePost(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "unlikePost.php?id=" + encodeURIComponent(id), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            ambilPost();
        }
    };
    xhr.send();    
}
