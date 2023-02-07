<html>
<body>
<form method="POST" action="api.php?act=Benefit&method=modify">
    <input type="text" name="id" placeholder="Enter id"> <br>
    <input type="text" name="full_name" placeholder="Enter full name"> <br>
    <input type="text" name="short_name" placeholder="Enter short name "> <br>
    <input type="text" name="category_name" placeholder="Enter category name"> <br>
    <input type="text" name="group_name" placeholder="Enter group name"> <br>
    <input type="text" name="start_date" placeholder="Enter start date"> <br>
    <input type="text" name="end_date" placeholder="Enter end date"> <br>

    <input type="checkbox" name="special_right" >special right<Br>
    <input type="checkbox" name="advantage_right"  >advantage right<Br>
    <input type="checkbox" name="base_VI" >base VI<Br>
    <input type="checkbox" name="special_base_VI" >special base VI<Br>
    <input type="checkbox" name="bvi" >BVI<Br>

    <button type="submit">Send</button>
    <br>
</body>
</html>