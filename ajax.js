async function getProductById(productId) {
    const url = "productdetail.php";
    const data = {
        id: productId
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

    const description = document.querySelector('#productDescription');
    const name = document.querySelector('#productName');
    name.innerHTML = result.product_name;
    description.innerHTML = result.product_description;
    var myModal = new bootstrap.Modal(document.getElementById('modal'), option);
    myModal.show();
}

async function getProductByCategory() {
    var checkBox = document.querySelectorAll(".myCheck");
    const url = "productByCategory.php";
    var categoryId = [];

    checkBox.forEach(element => {
        if (element.checked) {
            categoryId.push(element.id);
        }
    });
    //  console.table(categoryId);
    const data = {
        id: categoryId
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

    console.table(result);
    const productByCategory = document.getElementById("productByCategory");
    productByCategory.innerHTML = '';

    result.forEach(element => {
        productByCategory.innerHTML += `<div class="col-md-4">
          <div class="card">
              <a href="#">
                  <img src="./public/images/${element.product_photo} ?>" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                  <h5 class="card-title" data-bs-toggle="modal" data-bs-target="#modal" onclick="getProductById(${element.id})">${element.product_name}</h5>
                  <p class="card-text">${element.product_price}</p>
              </div>
          </div>
      </div>`
    });

}

async function searchProduct() {
    const searchResult =  document.querySelector('#search-result');
    const url = "searchajax.php";
    const data = {
        key: document.querySelector('#search').value
    };

    searchResult.innerHTML = '';

    if (data.key) {
        return;
    }

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

    if (data.key) {
        result.forEach(e => {
            const productName = e.product_name.split(data.key).join(`<span class="bg-dark text-light">${data.key}</span>`);
            searchResult.innerHTML += `<li class="list-group-item">${productName}</li>`;
        });
        let a = new Mark('.list-group-item')
        a.unmark()
        a.mark(data.key)
    }
}

async function loadmore() {
    const searchResult =  document.querySelector('#load-more');
    const url = "pagination.php";

    const data = {
        key: ++searchResult.value
    };

    const loader = document.querySelector('#heart');
    loader.style.display = 'block';

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

    console.table(result)

    if (result.length<3) {
        searchResult.setAttribute('disabled','')
    }

    result.forEach(element => {
        productByCategory.innerHTML += `<div class="col-md-4">
          <div class="card">
              <a href="#">
                  <img src="./public/images/${element.product_photo} ?>" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                  <h5 class="card-title" data-bs-toggle="modal" data-bs-target="#modal" onclick="getProductById(${element.id})">${element.product_name}</h5>
                  <p class="card-text">${element.product_price}</p>
              </div>
          </div>
      </div>`
    });

    loader.style.display = 'none';
    searchResult.scrollIntoView();
}

document.querySelector('#load-more').addEventListener('click',loadmore)