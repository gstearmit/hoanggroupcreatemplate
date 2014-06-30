<!--Navigation Background Part Starts -->
<div id="navigation-bg">
    <!--Navigation Part Starts -->
    <div id="navigation">
        <ul class="mainMenu">
            <li><?php echo $html->link('Home', array('controller'=>'jobs', 'action' => 'index'));?></li>
            <li><?php echo $html->link('Categories', array('controller'=>'categories', 'action' => 'index'));?></li>
            <li><?php echo $html->link('Users', array('controller'=>'users', 'action' => 'index'));?></li>
        </ul>
        <a href="#" class="signup" title="signup now"></a>
    </div>
    <!--Navigation Part Ends -->
</div>
<!--Navigation Background Part Ends -->