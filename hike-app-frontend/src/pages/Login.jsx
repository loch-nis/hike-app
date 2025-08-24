import { Link } from "react-router-dom";
import { Logo } from "../ui/Logo";
import { LoginForm } from "../features/authentication/LoginForm";
import { Heading } from "../ui/Heading";

export function Login() {
  return (
    <div className="flex min-h-full flex-1 flex-col justify-center lg:px-6 lg:py-12">
      <Logo />
      <Heading>Log in to your account </Heading>

      <div className="mt-5 lg:mx-auto lg:w-full lg:max-w-sm">
        <LoginForm />
        <p className="mt-10 text-center text-sm/6 text-gray-500">
          Don't have an account?{" "}
          <Link
            to={"/auth/register"}
            className="text-brand-orange hover:text-brand-bronze font-semibold"
          >
            Create one here
          </Link>
        </p>
      </div>
    </div>
  );
}
