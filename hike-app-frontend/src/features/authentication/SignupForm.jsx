import { useForm } from "react-hook-form";
import { Button } from "../../ui/Button";
import FormRow from "../../ui/FormRow";
import Input from "../../ui/Input";
import { SpinnerMini } from "../../ui/SpinnerMini";
import { useSignup } from "./useSignup";

export default function SignupForm() {
  const { signup, isPending } = useSignup();
  const { register, formState, handleSubmit, getValues, reset } = useForm();
  const { errors } = formState;

  function onSubmit({ firstName, lastName, email, password }) {
    signup(
      { firstName, lastName, email, password },
      {
        onSettled: () => {
          reset();
        },
      },
    );
  }
  return (
    <form className="space-y-6" noValidate onSubmit={handleSubmit(onSubmit)}>
      <FormRow
        label="First name"
        htmlFor="firstName"
        action={
          <span className="text-red-500">{errors?.firstName?.message}</span>
        }
      >
        <Input
          id="firstName"
          type="text"
          autoComplete="First name"
          {...register("firstName", {
            required: "This field is required",
          })}
        />
      </FormRow>
      <FormRow
        label="Last name"
        htmlFor="lastName"
        action={
          <span className="text-red-500">{errors?.lastName?.message}</span>
        }
      >
        <Input
          id="Last name"
          type="text"
          autoComplete="Last name"
          {...register("lastName", {
            required: "This field is required",
          })}
        />
      </FormRow>
      <FormRow
        label={"Email address"}
        htmlFor="email"
        action={<span className="text-red-500">{errors?.email?.message}</span>}
      >
        <Input
          id="email"
          type="email"
          autoComplete="email"
          {...register("email", {
            required: "This field is required",
            pattern: {
              value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
              message: "Invalid email address",
            },
          })}
        />
      </FormRow>
      <FormRow
        label="Password"
        htmlFor="password"
        action={
          <span className="text-red-500">{errors?.password?.message}</span>
        }
      >
        <Input
          id="password"
          type="password"
          {...register("password", {
            required: "This field is required",
            minLength: {
              value: 3,
              message: "Password must be atleast 3 characters",
            },
          })}
        />
      </FormRow>
      <FormRow
        label="Repeat password"
        htmlFor="passwordConfirm"
        action={
          <span className="text-red-500">
            {errors?.passwordConfirm?.message}
          </span>
        }
      >
        <Input
          id="passwordConfirm"
          type="password"
          {...register("passwordConfirm", {
            required: "This field is required",
            validate: (value) =>
              value === getValues().password || "Passwords must match",
          })}
        />
      </FormRow>
      <Button disabled={isPending}>
        {isPending ? <SpinnerMini /> : "Sign up"}
      </Button>
    </form>
  );
}
