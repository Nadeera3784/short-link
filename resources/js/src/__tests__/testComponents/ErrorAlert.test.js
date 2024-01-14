import { describe, expect, it } from 'vitest';
import { mount } from '@vue/test-utils';
import ErrorAlert from '../../Components/Alerts/ErrorAlert.vue';

describe('Error alert component', () => {

  it('should render error alerts', async () => {
    const wrapper = mount(ErrorAlert, {
      props: {
        message: 'Something went wrong',
        visibility: true
      }
    });
    expect(wrapper.exists()).toBe(true);
    expect(wrapper.find('h3').exists()).toBe(true);
    expect(wrapper.find('h3').text()).toBe('Something went wrong');
    expect(wrapper.props().visibility).toBe(true);
  });

  it('should not render error message when message is emtpy', async () => {
    const wrapper = mount(ErrorAlert, {
      props: {
        message: '',
        visibility: true
      }
    });
    expect(wrapper.props().message).toBe('');
    expect(wrapper.find('h3').text()).toBe('');
  });

});
