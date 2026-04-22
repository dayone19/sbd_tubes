<div class="bg-black text-white font-sans">

    <!-- NEWSLETTER -->
    <div class="relative min-h-175 px-4 flex items-start justify-center pt-20">
        
        <!-- BACKGROUND -->
        <div class="absolute inset-0 z-0">
            <img src="https://content.discogs.com/media/record-store-wall-sale-1536x1015.jpg"
                class="w-full h-full object-cover object-[center_85%] grayscale opacity-30"
                alt="Vinyl Background">

            <!-- overlay -->
            <div class="absolute inset-0 bg-linier-to-b from-black/20 via-black/50 to-black/80"></div>
        </div>

        <!-- CONTENT -->
        <div class="relative z-10 max-w-xl w-full text-center">
            
            <h2 class="text-2xl font-bold tracking-widest uppercase mb-4">
                Seller Newsletter
            </h2>
 
            <p class="text-base font-normal text-zinc-300 mb-6 leading-relaxed">
                Want to learn more about selling on Discogs? Stay informed about the <br>
                latest tools, tips, and resources.
            </p>

            <form action="#" method="POST" class="space-y-4">
                @csrf

                <div class="text-left">
                    <label class="block font-bold mb-1 tracking-tight">
                        Email
                    </label>
                    <input type="email" placeholder="   you@example.com"
                        class="text-sm w-full p-2 rounded-full bg-white text-black focus:outline-none">
                </div>

                <p class="text-xs leading-relaxed tracking-wide text-zinc-400 text-left">
                    By entering my email address, I consent to receive communications about music, promotions, <br> and Discogs. Unsubscribe at any time using the “unsubscribe” link in the emails. Learn more <br> about your rights and how Discogs handles your personal data by reviewing the Privacy Policy.
                </p>

                <button type="submit"
                class="text-sm w-full p-2 px-6 bg-zinc-700 text-white !rounded-full focus:outline-none">
                Subscribe
                </button>
            </form>

        </div>
    </div>

</div>