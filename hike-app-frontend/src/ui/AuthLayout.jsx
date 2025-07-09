import { Outlet } from "react-router-dom";

export default function AuthLayout() {
  return (
    <div className="flex h-screen justify-center bg-cover bg-center lg:justify-end lg:bg-[url(/wide-wallpaper.png)]">
      <div className="flex max-h-full bg-white lg:w-1/3">
        <Outlet />
      </div>
    </div>
  );
}
