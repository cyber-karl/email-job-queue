import React, { useState } from 'react'
import './App.css'
import { chainJob, subscribeNewUser } from "./api/email.ts";

function App() {
    const [subscribing, setSubscribing] = useState(false);
    const [chaining, setChaining] = useState(false);
    const [subscribeEmail, setSubscribeEmail] = useState("");
    const [chainEmail, setChainEmail] = useState("");

    async function handleSubscribe(e: React.FormEvent) {
        e.preventDefault();
        setSubscribing(true);
        try {
            const data = await subscribeNewUser(subscribeEmail);
            if (!data.success) {
                console.log(data.message);
                alert("Oh no! " + data.message);
                return;
            }
            alert(`Added "${subscribeEmail}"`);
        } catch (err) {
            console.log(err);
            alert(err.toString());
        } finally {
            setSubscribing(false);
        }
    }

    async function handleChain(e: React.FormEvent) {
        e.preventDefault();
        setChaining(true);
        try {
            const data = await chainJob(chainEmail);
            if (!data.success) {
                console.log(data.message);
                alert("Oh no! " + data.message);
                return;
            }
            alert(`Job chain kicked off!`);
        } catch (err) {
            console.log(err);
            alert(err.toString());
        } finally {
            setChaining(false);
        }
    }

    return (
        <div className={`flex flex-col justify-center items-center space-y-32 w-[40vw]`}>
            <form onSubmit={handleSubscribe} className={`flex flex-col space-y-8 justify-center items-center`}>
                <h1>Want to hear more?</h1>
                <input
                    name="subscribeEmail"
                    type="email"
                    value={subscribeEmail}
                    onChange={(e) => setSubscribeEmail(e.target.value)}
                    placeholder="Type your email..."
                    className={`border-white border-1 rounded-lg w-128 h-16 text-xl p-4`}
                    required
                />
                <button type="submit" disabled={subscribing}>
                    {subscribing ? "Subscribing..." : "Subscribe"}
                </button>
            </form>

            <form onSubmit={handleChain} className={`flex flex-col space-y-8 justify-center items-center`}>
                <h1>Want to kick off a parallel job?</h1>
                <input
                    name="chainEmail"
                    type="email"
                    value={chainEmail}
                    onChange={(e) => setChainEmail(e.target.value)}
                    placeholder="Type your email..."
                    className={`border-white border-1 rounded-lg w-128 h-16 text-xl p-4`}
                    required
                />
                <button type="submit" disabled={chaining}>
                    {chaining ? "Chaining" : "Chain"}
                </button>
            </form>
        </div>
    )
}

export default App
