import { useState, useActionState } from 'react'
import './App.css'
import {subscribeNewUser} from "./api/email.ts";

function App() {
    const [subscribing, setSubscribing] = useState(false);

    async function subscribe(prevState, formData) {
        "use server";
        setSubscribing(true);
        const email = formData.get("email");
        try {
            const data = await subscribeNewUser(email);
            if (!data.success) {
                console.log(data.message);
                alert("Oh no! " + data.message);
                return;
            }
            alert(`Added "${email}"`);
        } catch (err) {
            console.log(err);
            return err.toString();
        } finally {
            setSubscribing(false);
        }
    }

    const [message, subscribeAction] = useActionState(subscribe, null);

    return (
        <div className={`flex flex-col justify-center items-center`}>
            <form action={subscribeAction} className={`flex flex-col space-y-8`}>
                <h1>Want to hear more?</h1>
                <input
                    name="email"
                    type="email"
                    placeholder="Type your email..."
                    className={`border-white border-1 rounded-lg w-128 h-16 text-xl p-4`}
                />
                <button type="submit" disabled={subscribing}>
                    {subscribing ? "Subscribing..." : "Subscribe"}
                </button>
            </form>
      </div>
  )
}

export default App
