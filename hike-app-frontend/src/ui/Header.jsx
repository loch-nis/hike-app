import { Link } from "react-router-dom";
import { useUser } from "../features/authentication/useUser";
import { useLogout } from "../features/authentication/useLogout";

export function Header() {
  const { user } = useUser();
  const { logout } = useLogout();

  return (
    <header className="z-20 bg-gray-50 p-2 shadow-lg">
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <Link to={"/hikes"}>My Hikes</Link>
          <h1>Hike App</h1>
        </div>
        <div className="flex items-center space-x-4">
          <h2>Hello, {user.firstName} ☀</h2>
          <button type="button" onClick={() => logout()}>
            Log out temp
          </button>
        </div>
      </div>
    </header>
  );
}
