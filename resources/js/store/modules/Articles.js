const state = {
    activepage: 1,
    isLoading: false,
    loadedPages: [],
    ActiveArticles: []
};
const getters = {
    getActiveArticles: (state) => state.ActiveArticles,
    getActivePage: (state) => state.activepage,
    getLoadingStatus: (state) => state.isLoading,
};
const actions = {
    getPageArticles({ commit, state }, { url = 1 }) {
        // get the page number from the url or the data if exists already
        const convertedurl = new URL(url);
        let thispage = convertedurl.searchParams.get("page");
        console.log("loadedPages", state.loadedPages);
        // change page without reloading old data
        if (!state.loadedPages[thispage]) {
            console.log("loading");
            commit("setLoading", true);
            fetch(url + "&request=api")
                .then((response) => response.json())
                .then((data) => {
                    commit("setloadedPages", { page: thispage, data: data });
                    commit("setArticles", data);
                    commit("setLoading", false);
                })
                .catch((err) => console.log("error", err));
        } else {
            commit("setArticles", state.loadedPages[thispage]);
        }
        commit("setPage", thispage);
    },
};
const mutations = {
    setPage: (state, page) => (state.activepage = page),
    setArticles: (state, articles) => (state.ActiveArticles = articles),
    setLoading: (state, loading) => (state.isLoading = loading),
    setShown: (state, shown) => (state.isShown = shown),
    setloadedPages: (state, articles) => {
        console.log("getted data", articles);
        state.loadedPages[articles.page] = articles.data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations
};