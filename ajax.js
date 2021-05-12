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
    const url = "searchajax.php";
    const data = {
        key: document.querySelector('#search').value
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

    const searchResult =  document.querySelector('#search-result');
    console.table(result);
    searchResult.innerHTML = '';
    if (data.key != '') {
        result.forEach(e => {
            searchResult.innerHTML += `<li class="list-group-item">${e.product_name.split(data.key).join(`<span class="bg-dark text-light">${data.key}</span>`)}</li>`;
        });
    }
}

function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}