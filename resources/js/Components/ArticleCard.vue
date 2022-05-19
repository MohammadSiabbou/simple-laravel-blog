                    <div v-for="article in articles.data" :key="article.id" class="bg-white p-5 rounded-md">
                        <h3 class="text-lg font-bold">{{ article.title }}</h3>
                        <p class="mt-4 text-sm leading-4 text-zinc-700">{{ article.content }}</p>
                    </div>