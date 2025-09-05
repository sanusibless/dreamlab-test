import { createContext, useContext } from "react";
import toast from "react-hot-toast";

const notify = (type, message) => {
    if(type === 'error') {
        toast.error(message);
    } else {
        toast.success(message);
    }
}
const NotifyContext = createContext(notify);

export const useNotify = () => useContext(NotifyContext);
