<x-layout title="Contact Us">
    <div class="max-w-4xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-[#4CAF50] text-center">Get in Touch with Us!</h1>
        <p class="mb-4 text-gray-700">
            We're here to help and answer any questions you may have about <strong>Book Tracker</strong>. Reach out to us, and we’ll respond as soon as we can.
        </p>
        
        <ul class="list-none mb-6 space-y-2">
            <li class="flex items-center">
                <i class="fas fa-envelope text-[#4CAF50] mr-3"></i>
                <span><strong>Email:</strong> m.miari@outlook.com</span>
            </li>
            <li class="flex items-center">
                <i class="fas fa-phone text-[#4CAF50] mr-3"></i>
                <span><strong>Phone:</strong> +44 7888445574</span>
            </li>
            <li class="flex items-center">
                <i class="fas fa-map-marker-alt text-[#4CAF50] mr-3"></i>
                <span><strong>Address:</strong> 12 Rook Street, Huddersfield, UK</span>
            </li>
        </ul>
        
        <p class="mb-6 text-gray-700">
            Alternatively, you can fill out the form below, and we’ll be happy to assist you:
        </p>

        <!-- Contact Form -->
        <form class="space-y-4" action="" method="POST">
            @csrf
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                <input type="text" id="name" name="name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="John Doe">
            </div>
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                <input type="email" id="email" name="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="you@example.com">
            </div>
            <!-- Message Field -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                <textarea id="message" name="message" rows="5"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#4CAF50] focus:border-[#4CAF50] sm:text-sm"
                    placeholder="Your message here..."></textarea>
            </div>
            <!-- Submit Button -->
            <div>
                <button type="button" class="bg-[#4CAF50] text-white px-6 py-3 rounded-md hover:bg-[#45a049] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4CAF50]" 
                        onClick="window.location.reload();">
                    Send Message
                </button>
            </div>
        </form>

        <p class="mt-6 text-gray-700">
            We aim to respond to all queries within 24 hours. Thank you for reaching out to us!
        </p>
        
        <!-- Social Media Links (Not real links) -->
        <div class="mt-6">
            <p class="mb-2 text-gray-700">Follow us on social media:</p>
            <div class="flex space-x-4">
                <a href="https://facebook.com" target="_blank" class="flex items-center text-[#4CAF50] hover:text-[#388e3c]">
                    <i class="fab fa-facebook mr-2"></i> Facebook
                </a>
                <a href="https://twitter.com" target="_blank" class="flex items-center text-[#4CAF50] hover:text-[#388e3c]">
                    <i class="fab fa-twitter mr-2"></i> Twitter
                </a>
                <a href="https://instagram.com" target="_blank" class="flex items-center text-[#4CAF50] hover:text-[#388e3c]">
                    <i class="fab fa-instagram mr-2"></i> Instagram
                </a>
            </div>
        </div>
    </div>
</x-layout>
