import { Logo } from "../ui/Logo";
import { Link } from "react-router-dom";
import { SignupForm } from "../features/authentication/SignupForm";
import { Heading } from "../ui/Heading";

export function Signup() {
  // todo have authLayout or authPageLayout include more of these wrapper divs

  return (
    <>
      <div className="flex min-h-full flex-1 flex-col justify-center lg:px-6 lg:py-12">
        <Logo />
        <Heading>Create new account</Heading>

        <div className="mt-5 lg:mx-auto lg:w-full lg:max-w-sm">
          <SignupForm />
          <p className="mt-10 text-center text-sm/6 text-gray-500">
            Already have an account?{" "}
            <Link
              to={"/auth/login"}
              className="text-brand-orange hover:text-brand-bronze font-semibold"
            >
              Log in here instead
            </Link>
          </p>
        </div>
      </div>
    </>
  );
}
