<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    
    body {
    background-color: #ccc;
    }

    .con {
        display: grid;
        place-items: center;
        height: 100vh;
    }

    input {
        outline: none;
        border: none;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, .1);
        padding: 1rem 1.5rem;
    }


    #submit:hover {
        background-color: blueviolet;
        color:white; 
    }

</style>


<body>
    <div class="con">
        <!-- <form method="post" id="frm">
            <input type="text" name="comm" id="comm" placeholder="Comment Here">
            <input type="submit" value="submit" id="submit">
        </form> -->
        <form method="post" id="frm" action="insert.php">
            <input type="text" id="notify"  name="notify" placeholder="Comment Here">
            <button type="submit">Submit</button>
        </form> 
    </div>

    <script>
        const frm = document.getElementById('frm');

        document.getElementById('submit').addEventListener('click', (e)=>{
            // prevent defualt referesh:

            e.preventDefault();

            // create new http request instance:

            let insert_xhr = new XMLHttpRequest();

            insert_xhr.open('post','insert.php', true);

            let userInput = document.getElementById('comm').value;

            // make an object data for sending to php:

            let formdata = "msg="+userInput;

            // load the response:

            insert_xhr.onload = function() {

                if (insert_xhr.status == 200) {
                    let get_data = JSON.parse(insert_xhr.responseText);

                    if (get_data == 'added') {
                        alert("comment added");
                    }

                }

            }


            insert_xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            insert_xhr.send(formdata);


        })
    </script>

</body>
  
</html>