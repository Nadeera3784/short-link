import { describe, expect, it } from 'vitest';
import { mount} from '@vue/test-utils';
import SpinLoader from '../../Components/Loader/SpinLoader.vue';

describe('SpinLoader component', () => {
  it('should render the spinner when visibility is true', async () => {
    const wrapper = mount(SpinLoader, {
      props: {
        visibility: true,
      },
    });
    expect(wrapper.exists()).toBe(true);
    expect(wrapper.find('svg').isVisible()).toBe(true);
  });;

});
