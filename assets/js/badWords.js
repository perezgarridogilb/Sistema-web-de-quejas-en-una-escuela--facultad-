function containsBadWords(content) {
    const badWords = new Set(['idiotas', 'idiota', 'pendejo', 'pendejos', 'baboso', 'babosos', 'babosa', 'babosas', 'estupido', 'estupidos', 'estupida', 'estupidas', 'imbecil', 'imbeciles']);
    const normalizedWords = new Set(content.split(" ").map(word => word.trim().toLowerCase()));

    return [...badWords].filter(word => normalizedWords.has(word)).length > 0;
}