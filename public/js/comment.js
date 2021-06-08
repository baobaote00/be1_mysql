document.querySelector('.comment-submit').addEventListener('click', comment)

async function comment(e) {
    const url = "../comment.php";
    let textAreaComment = document.querySelector('#comment');
    let rating = document.querySelector('#rating')
    let id = document.querySelector('#product-id')

    if (rating.value>5||rating.value<0) {
        alert('rating phải lớn hơn 0 và bé hơn 5')
        return;
    }

    const data = {
        comment: textAreaComment.value,
        rating: rating.value,
        productId: id.value
    };

    //gửi yêu cầu lên server
    const request = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/json; charset=utf-8'
        },
        body: JSON.stringify(data)
    });

    //nhận kết quả trả về
    const result = await request.json();

    if (result) {
        alert('success')
        document.querySelector('.form-view-comment').innerHTML += `<span class="comment-view">${data.comment}</span>`
        textAreaComment.value = ''
    }else{
        alert('error')
    }
}

