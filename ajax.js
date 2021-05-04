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

     const divResult = document.querySelector('#result');
     divResult.innerHTML = result.product_description;
 }