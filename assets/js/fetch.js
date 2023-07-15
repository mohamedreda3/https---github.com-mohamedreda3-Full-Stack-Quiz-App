const fetchData = async (file, formData) => {
      return fetch(file, { method: "POST", body: formData });
};