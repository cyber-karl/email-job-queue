const baseUrl = `${import.meta.env.VITE_API_URL}/api`

export async function subscribeNewUser(email: string): Promise<{ success: boolean; message: string }> {
    try {
        const response = await fetch(`${baseUrl}/subscribe`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return { success: true, message: data.message || 'Subscription successful' };
    } catch (err) {
        return { success: false, message: err instanceof Error ? err.message : 'An error occurred' };
    }
}

export async function chainJob(email: string): Promise<{ success: boolean; message: string }> {
    try {
        const response = await fetch(`${baseUrl}/chain`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return { success: true, message: data.message || 'Chain Successful' };
    } catch (err) {
        return { success: false, message: err instanceof Error ? err.message : 'An error occurred' };
    }
}
