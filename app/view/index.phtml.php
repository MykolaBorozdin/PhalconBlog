<!-- app/view/index.phtml -->
<html>
    <head>
        <title>Phalcon blog</title>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    </head>
    <body>
        <div style=" width:95vw;">
        <table>
            <tr>
                <td > 
                    <?= $this->getContent() ?>
                </td>
                <td style="vertical-align:top;">
                    <?php if ((!(isset($hideLogin)))) { ?>
                    <?php if (isset($currentUser)) { ?>
                        <p> Hello, <?= $currentUser ?>!</p>
                        <?= $this->tag->linkTo(['index/logout', 'Log out']) ?>
                        <div align="left">
                            <?php 
                            echo $this->tag->linkTo("article/new", "Create Article", "class:btn btn-primary");
                            ?>
                        </div>
                    <?php } else { ?>
                        <h2>Please, sign in using this form</h2>

                        <?php echo $this->tag->form("index/login"); ?>
                         <p>
                            <label for="email">E-Mail</label>
                            <?php echo $this->tag->emailField("email") ?>
                         </p>
                         
                         <p>
                            <label for="name">Password</label>
                            <?php echo $this->tag->passwordField("password") ?>
                         </p>
                        
                         <p>
                            <?php echo $this->tag->submitButton("Log in") ?>
                         </p>
                        
                        </form>
                        <?php 
                            echo $this->tag->linkTo("signup", "Sign Up Here!");
                        ?>
                    <?php } ?>
                    <?php } ?>
                </td>
            </tr>
        </table>
        </div>
    </body>
</html>

