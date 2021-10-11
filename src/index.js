import localforage from 'localforage';

(async () => {
    await localforage.setItem('hoge', 'Hello!');
    const data = await localforage.getItem('hoge');
    console.log(data);
}

)();