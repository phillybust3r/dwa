<!DOCTYPE html>

<head>

    <?
    # When debugging, we can print_r the $_POST. Now, it's commented out because we don't need it.
    //print_r($_POST);
    
    # Only do the following if we have $_POST variables. i.e, if the form has been submitted
    if($_POST) {
    
        # Pick and print a winning number 
            $how_many_contestants = count($_POST);
            $winning_number       = rand(1,$how_many_contestants);
            
        # Loop through contestants, seeing if any won
        # $input_name will be the name of the input field such as "contestant1" or "contestant2"
        # $value will be whatever was typed into that field
            foreach($_POST as $input_name => $value) {
                    
                # Generate a random number
                    $random_number = rand(1,$how_many_contestants);
                    
                # See if their generated random  number mathches the winning number
                
                    # First, we use this test to make sure the field was actually filled in and is not blank
                    if($value != "") {
                        if($random_number == $winning_number) {
                            # Note how we're storing our results in an array called $contestants. Again, $value is the name that was typed in.
                            $contestants[$value] = "Winner";
                        }
                        else {
                            $contestants[$value] = "Loser";            
                        }    
                    }                    
            } 
    } 
    ?>
    
</head>


<body>
    
    <!-- Our form to accept new contestants -->
        <form method='POST' action='index.php'>
            Username:
            <input type='text' name='username'> <br>          
       	    Password :  
            <input type='text' name='password'>            
            <input type='submit' value='Submit'><br>
        
		</form>    
    
    
    <!-- Print the results only if we have $_POST. i.e. if the form was submitted -->
        <? if($_POST): ?>
        
            The winning number is <?=$winning_number?>!<br><br>
                
            <? foreach($contestants as $index => $value): ?>
                <?=$index?> is a <?=$value?><br>
            <? endforeach; ?>
    
        <? endif; ?>    
    
</body>

</html>