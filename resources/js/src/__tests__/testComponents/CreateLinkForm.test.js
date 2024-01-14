import { describe, expect, it } from 'vitest';
import { mount } from '@vue/test-utils';
import CreateLinkForm from '../../Components/Forms/CreateLinkForm.vue';

function generateRandomUrl() {
    const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const length = Math.floor(Math.random() * (20 - 5) + 5); // Random length between 5 and 20
    let url = 'http://';
  
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      url += characters.charAt(randomIndex);
    }
  
    return url + '.com';
}

describe('CreateLinkForm component', () => {

  it('should render form', async () => {
     const wrapper = mount(CreateLinkForm);
     expect(wrapper.find('label').text()).toBe('Generate short url for free!');
     expect(wrapper.find('button').text()).toBe('Generate');
     expect(wrapper.find('input').exists()).toBe(true);
  });

  it('should show error message if input is  empty', async () => {
    const wrapper = mount(CreateLinkForm);
    await wrapper.find('button').trigger('click');
    expect(wrapper.find('h3').text()).toBe('URL is required');
  });

  it('should show error message if url is invalid', async () => {
    const wrapper = mount(CreateLinkForm);
    const input =  wrapper.find('input')
    input.element.value = 'invalid-url'
    input.trigger('input')
    await wrapper.find('button').trigger('click');
    expect(wrapper.find('h3').text()).toBe('Enter a valid URL');
  });

});
