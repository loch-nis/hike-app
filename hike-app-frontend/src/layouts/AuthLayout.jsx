import { Outlet } from "react-router-dom";

export function AuthLayout() {
  const images = ["canada.png", "sweden-forest.png", "sweden-camp.png"];
  const randomIndex = Math.floor(Math.random() * 3);
  const randomImage = images[randomIndex];

  return (
    <div className="flex h-screen">
      <div
        className={`hidden bg-cover bg-center lg:block lg:w-2/3`}
        style={{ backgroundImage: `url(/${randomImage})` }}
      ></div>
      <div className="flex max-h-full bg-white lg:w-1/3">
        <Outlet />
      </div>
    </div>
  );
}
// todo fix weird behavior on smaller screens
