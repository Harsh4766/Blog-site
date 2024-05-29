document.addEventListener('DOMContentLoaded', function() {
    fetch('get_posts.php')
        .then(response => response.json())
        .then(posts => {
            const content = document.getElementById('content');
            posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.className = 'post';
                postElement.innerHTML = `
                    <h2>${post.title}</h2>
                    <p>${post.body}</p>
                    <button class="btn btn-primary" onclick="viewPost(${post.id})">View</button>
                    <button class="btn btn-warning" onclick="editPost(${post.id})">Edit</button>
                    <button class="btn btn-danger" onclick="deletePost(${post.id})">Delete</button>`;
                content.appendChild(postElement);
            });
        });
});

function viewPost(postId) {
    window.location.href = `view_post.html?id=${postId}`;
}

function editPost(postId) {
    window.location.href = `edit_post.html?id=${postId}`;
}

function deletePost(postId) {
    fetch(`delete_post.php?id=${postId}`, {
        method: 'DELETE'
    }).then(response => response.text())
    .then(data => {
        alert(data);
        window.location.reload();
    });
}
