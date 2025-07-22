import { Outlet } from "react-router-dom";

export function AuthLayout() {
  // todo change bg picture here to one of my own - maybe from an actual hike I've been on?!?! and remove the firewatch stuff so no copyright
  return (
    <div className="flex h-screen justify-center bg-cover bg-center lg:justify-end lg:bg-[url(/wide-wallpaper.png)]">
      <div className="flex max-h-full bg-white lg:w-1/3">
        <Outlet />
      </div>
    </div>
  );
}

// todo check if good with a folder called layouts
