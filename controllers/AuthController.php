<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    private UserManager $manager;

    public function __construct()
    {
        $this->manager = new UserManager();
    }

    public function register() : void
    {
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "register")
        {
            // check if the email already exists
            if($this->manager->getUserByEmail($_POST["register-email"]) === null)
            {
                // check if the username already exists
                if($this->manager->getUserByUsername($_POST["register-username"]) === null)
                {
                    // check if the passwords match
                    if($_POST["register-password"] === $_POST["register-confirm-password"])
                    {
                        $password = password_hash($_POST["register-password"], PASSWORD_BCRYPT);
                        $email = $_POST["register-email"];
                        $username = $_POST["register-username"];

                        $user = $this->manager->createUser(new User($username, $email, $password));

                        // manually log the user
                        $_SESSION["user"] = $user->getId();

                        // redirect to the homepage
                        header("Location:/");
                    }
                    else
                    {
                        $this->render("auth/register", [
                            "errors" => [
                                "les mots de passe ne correspondent pas"
                            ]
                        ]);
                    }
                }
                else
                {
                    $this->render("auth/register", [
                        "errors" => [
                            "un utilisateur avec ce pseudo existe déjà"
                        ]
                    ]);
                }
            }
            else
            {
                $this->render("auth/register", [
                    "errors" => [
                        "un utilisateur avec cet email existe déjà"
                    ]
                ]);
            }
        }
        else
        {
            $this->render("auth/register", []);
        }
    }

    public function login() : void
    {
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "login")
        {
            $email = $_POST["login-email"];
            $password = $_POST["login-password"];

            // Check if the user exist
            $user = $this->manager->getUserByEmail($email);

            if($user !== null)
            {
                // check if the password is correct
                if(password_verify($password, $user->getPassword()))
                {
                    // log the user
                    $_SESSION["user"] = $user->getId();

                    // redirect to the homepage
                    header("Location:/");
                }
                else
                {
                    // nope, you get an error
                    $this->render("auth/login", [
                        "errors" => [
                            "Identifiants incorrects"
                        ]
                    ]);
                }
            }
            else
            {
                // and you get an error
                $this->render("auth/login", [
                    "errors" => [
                        "Identifiants incorrects"
                    ]
                ]);
            }
        }
        else
        {
            $this->render("auth/login", []);
        }
    }

    public function logout() : void
    {
        session_destroy();
        header("Location:/");
    }
}