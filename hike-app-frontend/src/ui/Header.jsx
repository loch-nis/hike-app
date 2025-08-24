import { Link } from "react-router-dom";
import { useUser } from "../features/authentication/useUser";
import { useLogout } from "../features/authentication/useLogout";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faDoorOpen } from "@fortawesome/free-solid-svg-icons";
import { LogoSmall } from "./LogoSmall";

export function Header() {
  const { user } = useUser();
  const { logout } = useLogout();

  return (
    <header className="z-20 bg-white p-2 shadow-lg">
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <Link to={"/hikes"}>
            <LogoSmall />
          </Link>
          <h2 className="text-2xl/9 font-bold text-gray-900">Hike App</h2>
        </div>
        <div className="flex items-center space-x-4">
          <h2 className="text-xl text-gray-900">Hello, {user.firstName} ☀</h2>
          <button
            className="bg-brand-orange group hover:bg-brand-bronze rounded-full border-2 border-black px-5 py-3 shadow-md hover:cursor-pointer hover:text-white"
            onClick={() => logout()}
          >
            <span className="mr-[10px]">
              <FontAwesomeIcon icon={faDoorOpen} />
            </span>
            <span>Log out</span>
          </button>
        </div>
      </div>
    </header>
  );
}
